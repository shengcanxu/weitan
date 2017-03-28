<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnergyStoreChangeRequest;
use App\Http\Requests\EnergyStoreRequest;
use App\Http\Requests\EnergyStoreTagErrorRequest;
use App\Models\EnergyStoreAnalysis;
use Illuminate\Http\Request;
use App\Models\EnergyStore;
use Illuminate\Queue\RedisQueue;


class EnergyStoreController extends Controller
{
    public function index(Request $request){
        $querytype = $request->get('type',null);
        $datefrom = $request->get('from', '1900-01-01');
        $dateto = $request->get('to', '2100-01-01');

        $store = EnergyStore::where('storedate',">=", $datefrom)->where('storedate',"<=", $dateto);
        if($querytype){
            $store = $store->where('type',"=", $querytype);
        }

        $items = $store->get();
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
        $store->author = $request->user()->id;
        $store->save();

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
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status'=>'fail','error'=>'id 不存在']);
    }

    public function tagerror(EnergyStoreTagErrorRequest $request, $id){
        $store = EnergyStore::find($id);
        if($store != null){
            $store->error = $request->get('error');
            $store->errorinfo = $request->get('message');
            $store->save();

            return response()->json(['status'=>'success']);
        }

        return response()->json(['status'=>'fail','error'=>'id 不存在']);
    }

    public function delete($id){
        $store = EnergyStore::find($id);
        if($store != null){
            $store->delete();
            return response()->json(['status'=>'success']);
        }

        return response()->json(['status'=>'fail','error'=>'id 不存在']);
    }

    public function analysis(Request $request, $id){
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
            return response()->json(['status'=>'success', 'id'=>$ids]);
        }

        return response()->json(['status'=>'fail','error'=>'energy_store_id 不存在']);
    }

    public function getanalysis(Request $request,$id){
        $analysises = EnergyStoreAnalysis::where("energy_store_id","=", $id)->get();

        $itemsArray = [];
        foreach ($analysises as $item){
            array_push($itemsArray, $item->attributesToArray());
        }
        return response()->json($itemsArray);
    }

    public function analysistagerror(EnergyStoreTagErrorRequest $request,$id, $aid){
        $analysis = EnergyStoreAnalysis::find($aid);
        if($analysis != null){
            $analysis->error = $request->get('error');
            $analysis->errorinfo = $request->get('message');
            $analysis->save();

            return response()->json(['status'=>'success']);
        }

        return response()->json(['status'=>'fail','error'=>'id 不存在']);
    }


}
