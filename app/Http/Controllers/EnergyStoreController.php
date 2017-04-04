<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnergyStoreRequest;
use App\Http\Requests\TagErrorRequest;
use App\Models\EnergyStoreAnalysis;
use Illuminate\Http\Request;
use App\Models\EnergyStore;
use App\Http\Requests\TypeGetRequest;


class EnergyStoreController extends Controller
{
    public function index(TypeGetRequest $request){
        $querytype = $request->get('type',null);
        $datefrom = $request->get('from', '1900-01-01');
        $dateto = $request->get('to', '2100-01-01');

        $store = EnergyStore::where('storedate',">=", $datefrom)->where('storedate',"<=", $dateto);
        if($querytype){
            $store = $store->where('type',"=", $querytype);
        }
        $items = $store->paginate(20);

        $items->load('author');
        $itemsArray = [];
        foreach ($items as $item){
            $item->author = $item->author()->first()->name;
            array_push($itemsArray, $item->attributesToArray());
        }
        return response()->json($itemsArray);
    }


    public function store(EnergyStoreRequest $request){
        $store = new EnergyStore();
        $store->storedate = $request->get('storedate');
        $store->type = $request->get('type');
        $store->batchno = $request->get('batchno');
        $store->number = $request->get('number');
        $store->remain = $store->number;
        $store->author = $request->user()->id;
        $store->save();

        \WeitanLog::log("新建了id=".$store->id."的化石燃料入厂数据",$request->user());
        return response()->json(['status'=>'success','id'=>$store->id]);
    }

    public function change(EnergyStoreRequest $request, $id){
        $store = EnergyStore::find($id);
        if($store != null) {
            $store->storedate = $request->get('storedate');
            $store->type = $request->get('type');
            $store->number = $request->get('number');
            $store->author = $request->user()->id;
            $store->save();
            \WeitanLog::log("修改了id=".$id."的化石燃料入厂数据",$request->user());
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status'=>'fail','error'=>'id 不存在']);
    }

    public function delete(Request $request, $id){
        $store = EnergyStore::find($id);
        if($store != null){
            $store->delete();
            \WeitanLog::log("删除了id=".$id."的化石燃料入厂数据",$request->user());
            return response()->json(['status'=>'success']);
        }

        return response()->json(['status'=>'fail','error'=>'id 不存在']);
    }

    public function tagerror(TagErrorRequest $request, $id){
        $store = EnergyStore::find($id);
        if($store != null){
            $store->error = $request->get('error');
            $store->errorinfo = $request->get('message');
            $store->save();

            \WeitanLog::log("对id=".$id."的化石燃料入厂数据标记错误信息：".$store->errorinfo,$request->user());
            return response()->json(['status'=>'success']);
        }

        return response()->json(['status'=>'fail','error'=>'id 不存在']);
    }

    public function storeanalysis(Request $request, $id){
        $store = EnergyStore::find($id);

        if($store) {
            $device = $request->get('device');
            $method = $request->get('method');
            $data = $request->get('data');
            $ids = [];
            foreach ($data as $item){
                $analysis = new EnergyStoreAnalysis();
                $analysis->energy_store_id = $id;
                $analysis->device = $device;
                $analysis->method = $method;
                $analysis->dwfrl = $item['dwfrl'];
                $analysis->dwrlhtl = $item['dwrlhtl'];
                $analysis->tyhl = $item['tyhl'];
                $analysis->author = $request->user()->id;
                $analysis->save();
                array_push($ids, $analysis->id);
            }

            $this->calculateCO2($store);
            \WeitanLog::log("新建了id=".$id."的化石燃料入厂数据检验结果",$request->user());
            return response()->json(['status'=>'success', 'id'=>$ids]);
        }

        return response()->json(['status'=>'fail','error'=>'energy_store_id 不存在']);
    }

    private function calculateCO2($store){
        $analysises = EnergyStoreAnalysis::where('energy_store_id','=',$store->id)->get();

        $dwfrl=0.0; $dwrlhtl=0.0; $tyhl=0.0;
        foreach ($analysises as $analysis){
            $dwfrl = $dwfrl + $analysis->dwfrl;
            $dwrlhtl = $dwrlhtl + $analysis->dwrlhtl;
            $tyhl = $tyhl + $analysis->tyhl;
        }
        $len = sizeof($analysises);
        $store->dwfrl = sprintf("%.4f" , $dwfrl / $len);
        $store->dwrlhtl = sprintf("%.4f" , $dwrlhtl / $len);
        $store->tyhl = sprintf("%.4f" , $tyhl / $len);
        $store->analysis = true;
        $store->save();
    }

    public function getanalysis(Request $request,$id){
        $analysises = EnergyStoreAnalysis::where("energy_store_id","=", $id)->get();

        $itemsArray = [];
        foreach ($analysises as $item){
            array_push($itemsArray, $item->attributesToArray());
        }
        return response()->json($itemsArray);
    }

    public function analysistagerror(TagErrorRequest $request, $id, $aid){
        $analysis = EnergyStoreAnalysis::find($aid);
        if($analysis != null){
            $analysis->error = $request->get('error');
            $analysis->errorinfo = $request->get('message');
            $analysis->save();

            \WeitanLog::log("对id=".$id."的化石燃料入厂数据检验结果标记错误信息：".$analysis->errorinfo,$request->user());
            return response()->json(['status'=>'success']);
        }

        return response()->json(['status'=>'fail','error'=>'id 不存在']);
    }


}
