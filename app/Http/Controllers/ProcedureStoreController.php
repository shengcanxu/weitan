<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TypeGetRequest;
use App\Http\Requests\ProcedureStoreRequest;
use App\Http\Requests\TagErrorRequest;
use App\Models\ProcedureStore;
use App\Models\ProcedureStoreAnalysis;

class ProcedureStoreController extends Controller
{
    public function index(TypeGetRequest $request){
        $querytype = $request->get('type',null);
        $datefrom = $request->get('from', '1900-01-01');
        $dateto = $request->get('to', '2100-01-01');

        $store = ProcedureStore::where('storedate',">=", $datefrom)->where('storedate',"<=", $dateto);
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

    public function store(ProcedureStoreRequest $request){
        $store = new ProcedureStore();
        $store->storedate = $request->get('storedate');
        $store->type = $request->get('type');
        $store->batchno = $request->get('batchno');
        $store->number = $request->get('number');
        $store->remain = $store->number;
        $store->author = $request->user()->id;
        $store->save();

        \WeitanLog::log("新建了id=".$store->id."的过程排放入厂数据",$request->user());
        return response()->json(['status'=>'success','id'=>$store->id]);
    }

    public function change(ProcedureStoreRequest $request, $id){
        $store = ProcedureStore::find($id);
        if($store != null) {
            $store->storedate = $request->get('storedate');
            $store->type = $request->get('type');
            $store->number = $request->get('number');
            $store->author = $request->user()->id;
            $store->save();
            \WeitanLog::log("修改了id=".$id."的过程排放入厂数据",$request->user());
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status'=>'fail','error'=>'id 不存在']);
    }

    public function delete(Request $request, $id){
        $store = ProcedureStore::find($id);
        if($store != null){
            $store->delete();
            \WeitanLog::log("删除了id=".$id."的过程排放入厂数据",$request->user());
            return response()->json(['status'=>'success']);
        }

        return response()->json(['status'=>'fail','error'=>'id 不存在']);
    }

    public function tagerror(TagErrorRequest $request, $id){
        $store = ProcedureStore::find($id);
        if($store != null){
            $store->error = $request->get('error');
            $store->errorinfo = $request->get('message');
            $store->save();

            \WeitanLog::log("对id=".$id."的过程排放入厂数据标记错误信息：".$store->errorinfo,$request->user());
            return response()->json(['status'=>'success']);
        }

        return response()->json(['status'=>'fail','error'=>'id 不存在']);
    }

    public function storeanalysis(Request $request, $id){
        $store = ProcedureStore::find($id);

        if($store) {
            $device = $request->get('device');
            $method = $request->get('method');
            $data = $request->get('data');
            $ids = [];
            foreach ($data as $item){
                $analysis = new ProcedureStoreAnalysis();
                $analysis->procedure_store_id = $id;
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
            \WeitanLog::log("新建了id=".$id."的过程排放入厂数据检验结果",$request->user());
            return response()->json(['status'=>'success', 'id'=>$ids]);
        }

        return response()->json(['status'=>'fail','error'=>'energy_store_id 不存在']);
    }

    private function calculateCO2($store){
        $analysises = ProcedureStoreAnalysis::where('procedure_store_id','=',$store->id)->get();

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

    public function getanalysis(Request $request,$id){
        $analysises = ProcedureStoreAnalysis::where("procedure_store_id","=", $id)->get();

        $itemsArray = [];
        foreach ($analysises as $item){
            array_push($itemsArray, $item->attributesToArray());
        }
        return response()->json($itemsArray);
    }

    public function analysistagerror(TagErrorRequest $request, $id, $aid){
        $analysis = ProcedureStoreAnalysis::find($aid);
        if($analysis != null){
            $analysis->error = $request->get('error');
            $analysis->errorinfo = $request->get('message');
            $analysis->save();

            \WeitanLog::log("对id=".$id."的过程排放入厂数据检验结果标记错误信息：".$analysis->errorinfo,$request->user());
            return response()->json(['status'=>'success']);
        }

        return response()->json(['status'=>'fail','error'=>'id 不存在']);
    }

}
