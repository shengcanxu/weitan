<?php

namespace App\Http\Controllers;

use App\Models\ProcedureStore;
use Illuminate\Http\Request;
use App\Http\Requests\TypeGetRequest;
use App\Models\ProcedureUsage;
use App\Http\Requests\EnergyUsageRequest;
use App\Http\Requests\TagErrorRequest;
use App\Models\ProcedureUsageAnalysis;

class ProcedureUsageController extends Controller
{
    public function index(TypeGetRequest $request){
        $querytype = $request->get('type',null);
        $datefrom = $request->get('from', '1900-01-01');
        $dateto = $request->get('to', '2100-01-01');

        $store = ProcedureUsage::where('usagedate',">=", $datefrom)->where('usagedate',"<=", $dateto);
        if($querytype){
            $store = $store->where('type',"=", $querytype);
        }
        $items = $store->paginate(20);

        $items->load('procedurestore');
        $items->load('author');
        $itemsArray = [];
        foreach ($items as $item){
            $item->author = $item->author()->first()->name;
            $item->procedurestore = $item->procedurestore()->first();
            array_push($itemsArray, $item->attributesToArray());
        }
        return response()->json($itemsArray);
    }

    public function store(EnergyUsageRequest $request){
        $usage = new ProcedureUsage();
        $usage->procedurestore = $request->get('store_id');
        $store = ProcedureStore::find($usage->procedurestore);

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

            \WeitanLog::log("新建了id=".$usage->id."的过程排放使用数据",$request->user());
            return response()->json(['status' => 'success', 'id' => $usage->id]);
        }

        return response()->json(['status' => 'fail', 'error'=> '过程排放使用数据ID不存在']);
    }

    public function change(EnergyUsageRequest $request, $id){
        $usage = ProcedureUsage::find($id);
        $store = ProcedureStore::find($usage->procedurestore);
        if($usage != null) {
            $originalNumber = $usage->number;
            $usage->usagedate = $request->get('usagedate');
            $usage->number = $request->get('number');
            $usage->author = $request->user()->id;

            $store->usage = $store->usage + $usage->number - $originalNumber;
            $store->remain = $store->remain - $usage->number + $originalNumber;
            if($store->remain < 0 || $store->usage < 0){
                return response()->json(['status'=>'fail', 'error'=>'没有足够数量']);
            }
            $store->save();
            $usage->save();

            \WeitanLog::log("改变了id=".$id."的过程排放使用数据",$request->user());
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status'=>'fail','error'=>'id 不存在']);
    }

    public function delete(Request $request, $id){
        $usage = ProcedureUsage::find($id);
        if($usage != null){
            $usage->delete();

            \WeitanLog::log("删除了id=".$id."的过程排放使用数据",$request->user());
            return response()->json(['status'=>'success']);
        }

        return response()->json(['status'=>'fail','error'=>'id 不存在']);
    }

    public function tagerror(TagErrorRequest $request, $id){
        $usage = ProcedureUsage::find($id);
        if($usage != null){
            $usage->error = $request->get('error');
            $usage->errorinfo = $request->get('message');
            $usage->save();

            \WeitanLog::log("对id=".$id."的过程排放使用数据标记错误信息：".$usage->errorinfo,$request->user());
            return response()->json(['status'=>'success']);
        }

        return response()->json(['status'=>'fail','error'=>'id 不存在']);
    }

    public function getanalysis(Request $request,$id){
        $analysises = ProcedureUsageAnalysis::where("procedure_usage_id","=", $id)->get();

        $itemsArray = [];
        foreach ($analysises as $item){
            array_push($itemsArray, $item->attributesToArray());
        }
        return response()->json($itemsArray);
    }

    public function storeanalysis(Request $request, $id){
        $usage = ProcedureUsage::find($id);

        if($usage) {
            $device = $request->get('device');
            $method = $request->get('method');
            $data = $request->get('data');
            $ids = [];
            foreach ($data as $item){
                $analysis = new ProcedureUsageAnalysis();
                $analysis->procedure_usage_id = $id;
                $analysis->device = $device;
                $analysis->method = $method;
                $analysis->pfyz = $item['pfyz'];
                $analysis->author = $request->user()->id;
                $analysis->save();
                array_push($ids, $analysis->id);
            }

            $this->calculateCO2($usage);
            \WeitanLog::log("新建了id=".$id."的过程排放使用数据检验结果",$request->user());
            return response()->json(['status'=>'success', 'id'=>$ids]);
        }

        return response()->json(['status'=>'fail','error'=>'procedure_usage_id 不存在']);
    }

    private function calculateCO2($store){

    }

    public function analysistagerror(TagErrorRequest $request, $id, $aid){
        $analysis = ProcedureUsageAnalysis::find($aid);
        if($analysis != null){
            $analysis->error = $request->get('error');
            $analysis->errorinfo = $request->get('message');
            $analysis->save();

            \WeitanLog::log("对id=".$id."的过程排放使用数据检验结果标记错误信息：".$analysis->errorinfo,$request->user());
            return response()->json(['status'=>'success']);
        }

        return response()->json(['status'=>'fail','error'=>'id 不存在']);
    }
}
