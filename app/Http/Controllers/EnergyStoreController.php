<?php

namespace App\Http\Controllers;

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

        return response()->json(['status'=>'success']);
    }

    public function tagerror(EnergyStoreTagErrorRequest $request){
        $id = $request->get('id');
        $store = EnergyStore::find($id);
        if($store != null){
            $store->error = $request->get('error');
            $store->errorinfo = $request->get('message');
            $store->save();

            return response()->json(['status'=>'success']);
        }

        return response()->json(['status'=>'fail','error'=>'id 不存在']);
    }

    public function analysis(Request $request){
        $analysis = new EnergyStoreAnalysis();
        $analysis->energy_store_id = $request->get('energy_store_id');
        $store = EnergyStore::find($analysis->energy_store_id);

        if($store) {
            $analysis->device = $request->get('device');
            $analysis->method = $request->get('method');
            $analysis->dwfrl = $request->get('dwfrl');
            $analysis->dwrlhtl = $request->get('dwrlhtl');
            $analysis->tyhl = $request->get('tyhl');
            $analysis->author = $request->user()->id;
            $analysis->save();

            return response()->json(['status'=>'success']);
        }

        return response()->json(['status'=>'fail','error'=>'energy_store_id 不存在']);
    }

    public function getanalysis(Request $request){
        $id = $request->get('energy_store_id');
        $analysises = EnergyStoreAnalysis::where("energy_store_id","=", $id)->get();

        $itemsArray = [];
        foreach ($analysises as $item){
            array_push($itemsArray, $item->attributesToArray());
        }
        return response()->json($itemsArray);
    }


}
