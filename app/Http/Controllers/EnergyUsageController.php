<?php

namespace App\Http\Controllers;

use App\Models\EnergyStore;
use Illuminate\Http\Request;
use App\Models\EnergyUsage;
use App\Http\Requests\EnergyUsageRequest;

class EnergyUsageController extends Controller
{
    public function index(Request $request){
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
}
