<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnergyStoreRequest;
use App\Http\Requests\EnergyStoreTagErrorRequest;
use Illuminate\Http\Request;
use App\Models\EnergyStore;



class EnergyStoreController extends Controller
{
    public function index(){
        $items = EnergyStore::all();
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

        return response()->json(['status'=>'fail','error'=>'id not exists']);
    }



}
