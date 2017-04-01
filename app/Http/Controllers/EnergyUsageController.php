<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagErrorRequest;
use App\Models\EnergyStore;
use App\Models\PertypeCusage;
use Illuminate\Http\Request;
use App\Models\EnergyUsage;
use App\Http\Requests\EnergyUsageRequest;
use App\Models\EnergyUsageAnalysis;
use App\Http\Requests\EnergyStoreGetRequest;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class EnergyUsageController extends Controller
{
    public function index(EnergyStoreGetRequest $request){
        $querytype = $request->get('type',null);
        $datefrom = $request->get('from', '1900-01-01');
        $dateto = $request->get('to', '2100-01-01');

        $store = EnergyUsage::where('usagedate',">=", $datefrom)->where('usagedate',"<=", $dateto);
        if($querytype){
            $store = $store->where('type',"=", $querytype);
        }
        $items = $store->paginate(20);

        $items->load('energystore');
        $items->load('author');
        $itemsArray = [];
        foreach ($items as $item){
            $item->author = $item->author()->first()->name;
            $item->energystore = $item->energystore()->first();
            array_push($itemsArray, $item->attributesToArray());
        }
        return response()->json($itemsArray);
    }

    public function store(EnergyUsageRequest $request){
        $usage = new EnergyUsage();
        $usage->energystore = $request->get('store_id');
        $store = EnergyStore::find($usage->energystore);

        if($store != null) {
            $usage->usagedate = $request->get('usagedate');
            $usage->type = $store->type;
            $usage->number = $request->get('number');
            $usage->author = $request->user()->id;

            $store->usage = $store->usage + $usage->number;
            $store->remain = $store->remain - $usage->number;
            if($store->remain < 0){
                return response()->json(['status'=>'fail','error'=>'没有足够数量']);
            }
            $store->save();
            $usage->save();

            \WeitanLog::log("新建了id=".$usage->id."的入炉数据",$request->user());
            return response()->json(['status' => 'success', 'id' => $usage->id]);
        }

        return response()->json(['status' => 'fail', 'error'=> '入厂数据ID不存在']);
    }

    public function change(EnergyUsageRequest $request, $id){
        $usage = EnergyUsage::find($id);
        if($usage != null) {
            $usage->usagedate = $request->get('usagedate');
            $usage->number = $request->get('number');
            $usage->author = $request->user()->id;
            $usage->save();

            \WeitanLog::log("改变了id=".$id."的入炉数据",$request->user());
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status'=>'fail','error'=>'id 不存在']);
    }

    public function delete(Request $request, $id){
        $usage = EnergyUsage::find($id);
        if($usage != null){
            $usage->delete();

            \WeitanLog::log("删除了id=".$id."的入炉数据",$request->user());
            return response()->json(['status'=>'success']);
        }

        return response()->json(['status'=>'fail','error'=>'id 不存在']);
    }

    public function tagerror(TagErrorRequest $request, $id){
        $usage = EnergyUsage::find($id);
        if($usage != null){
            $usage->error = $request->get('error');
            $usage->errorinfo = $request->get('message');
            $usage->save();

            \WeitanLog::log("对id=".$id."的入炉数据标记错误信息：".$usage->errorinfo,$request->user());
            return response()->json(['status'=>'success']);
        }

        return response()->json(['status'=>'fail','error'=>'id 不存在']);
    }

    public function getanalysis(Request $request,$id){
        $analysises = EnergyUsageAnalysis::where("energy_usage_id","=", $id)->get();

        $itemsArray = [];
        foreach ($analysises as $item){
            array_push($itemsArray, $item->attributesToArray());
        }
        return response()->json($itemsArray);
    }

    public function storeanalysis(Request $request, $id){
        $usage = EnergyUsage::find($id);

        if($usage) {
            $device = $request->get('device');
            $method = $request->get('method');
            $data = $request->get('data');
            $ids = [];
            foreach ($data as $item){
                $analysis = new EnergyUsageAnalysis();
                $analysis->energy_usage_id = $id;
                $analysis->device = $device;
                $analysis->method = $method;
                $analysis->dwfrl = $item['dwfrl'];
                $analysis->dwrlhtl = $item['dwrlhtl'];
                $analysis->tyhl = $item['tyhl'];
                $analysis->author = $request->user()->id;
                $analysis->save();
                array_push($ids, $analysis->id);
            }

            $this->calculateCO2($usage);
            \WeitanLog::log("新建了id=".$id."的入厂数据检验结果",$request->user());
            return response()->json(['status'=>'success', 'id'=>$ids]);
        }

        return response()->json(['status'=>'fail','error'=>'energy_usage_id 不存在']);
    }

    private function calculateCO2($store){
        $analysises = EnergyUsageAnalysis::where('energy_usage_id','=',$store->id)->get();

        $dwfrl=0.0; $dwrlhtl=0.0; $tyhl=0.0;
        foreach ($analysises as $analysis){
            $dwfrl = $dwfrl + $analysis->dwfrl;
            $dwrlhtl = $dwrlhtl + $analysis->dwrlhtl;
            $tyhl = $tyhl + $analysis->tyhl;
        }
        $len = sizeof($analysises);
        $store->dwfrl = number_format($dwfrl / $len, 4);
        $store->dwrlhtl = number_format($dwrlhtl / $len,4);
        $store->tyhl = number_format($tyhl / $len,4);
        $store->analysis = true;
        $store->save();
    }

    public function docalculateCO2(){
        $config = json_decode(File::get(storage_path('app/weitan.config')));
        $fromdate = $config->CO2CalculateDate;
        $todate = (new \DateTime())->format('Y-m-d');
        $this->calculateCO2BetweenDates($fromdate, $todate);
        $config->CO2CalculateDate = $todate;
        File::put(storage_path('app/weitan.config'),json_encode($config));

        return response()->json(['status'=>'success']);
    }

    public function docalculateCO2AtDate($date){
        $this->calculateCO2ofDate($date);

        return response()->json(['status'=>'success']);
    }

    private function calculateCO2BetweenDates($fromdate, $todate){
        $from = new \DateTime($fromdate);
        $to = new \DateTime($todate);
        $diff = $from->diff($to)->days;
        for($i=0; $i<=$diff; $i++){
            $from = $from->add(new \DateInterval('P1D'));
            $this->calculateCO2ofDate($from->format('Y-m-d'));
        }
    }

    private function calculateCO2ofDate($date){
        $results = DB::select("SELECT usagedate, type, sum(number) as totoalnum, avg(dwfrl) as totaldwfrl, avg(dwrlhtl) as totaldwrlhtl, avg(tyhl) as totaltyhl FROM `energy_usages` where usagedate = '" . $date . "' group by  type");
        foreach ($results as $result){
            $usage = new PertypeCusage();
            $usage->date = $result->usagedate;
            $usage->type = $result->type;
            $usage->number = $result->totoalnum;
            $usage->dwfrl = $result->totaldwfrl;
            $usage->dwrlhtl = $result->totaldwrlhtl;
            $usage->tyhl = $result->totaltyhl;
            $usage->cusage = number_format($usage->number * $usage->dwfrl * $usage->dwrlhtl *$usage->tyhl * 44/12 , 4) ;
            $usage->save();
        }
    }

    public function analysistagerror(TagErrorRequest $request, $id, $aid){
        $analysis = EnergyUsageAnalysis::find($aid);
        if($analysis != null){
            $analysis->error = $request->get('error');
            $analysis->errorinfo = $request->get('message');
            $analysis->save();

            \WeitanLog::log("对id=".$id."的入炉数据检验结果标记错误信息：".$analysis->errorinfo,$request->user());
            return response()->json(['status'=>'success']);
        }

        return response()->json(['status'=>'fail','error'=>'id 不存在']);
    }

    public function CO2output(EnergyStoreGetRequest $request){
        $querytype = $request->get('type',null);
        $datefrom = $request->get('from', '1900-01-01');
        $dateto = $request->get('to', '2100-01-01');

        $store = PertypeCusage::where('date',">=", $datefrom)->where('date',"<=", $dateto);
        if($querytype){
            $store = $store->where('type',"=", $querytype);
        }
        $items = $store->paginate(20);

        $itemsArray = [];
        foreach ($items as $item){
            array_push($itemsArray, $item->attributesToArray());
        }
        return response()->json($itemsArray);
    }


}
