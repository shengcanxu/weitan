<?php

namespace App\Http\Controllers;

use App\Http\Requests\HeatOuterUsageRequest;
use Illuminate\Http\Request;
use App\Models\HeatOuterUsage;
use App\Http\Requests\TagErrorRequest;

class HeatOuterUsageController extends Controller
{
    public function index(Request $request){
        $items = HeatOuterUsage::paginate(20);

        $items->load('author');
        $itemsArray = [];
        foreach ($items as $item){
            $item->author = $item->author()->first()->name;
            array_push($itemsArray, $item->attributesToArray());
        }
        return response()->json($itemsArray);
    }

    public function store(HeatOuterUsageRequest $request){
        $usage = new HeatOuterUsage();
        $usage->month = $request->get('month');
        $usage->datasource = $request->get('datasource');
        $usage->temperature = $request->get('temperature');
        $usage->pressure = $request->get('pressure');
        $usage->heatquality = $request->get('heatquality');
        $usage->enthalpy = $request->get('enthalpy');
        $usage->heatusage = $request->get('heatusage');

        if($usage->enthalpy == 0 && $usage->heatusage == 0){
            return response()->json(['status'=>'fail', 'error'=>'焓值和供热量必须填写一个']);
        }
        if($usage->enthalpy == 0){
            $usage->enthalpy = sprintf("%.4f" , $usage->heatusage * 1000 / $usage->heatquality + 83.74);
        }
        if($usage->heatusage == 0){
            $usage->heatusage = sprintf("%.4f" , $usage->heatquality * ($usage->enthalpy - 83.74) / 1000 );
        }

        $usage->author = $request->user()->id;
        $usage->save();

        \WeitanLog::log("新建了id=".$usage->id."的热力使用外部证明",$request->user());
        return response()->json(['status'=>'success','id'=>$usage->id]);
    }

    public function change(HeatOuterUsageRequest $request, $id){
        $usage = HeatOuterUsage::find($id);
        if($usage != null) {
            $usage->month = $request->get('month');
            $usage->datasource = $request->get('datasource');
            $usage->temperature = $request->get('temperature');
            $usage->pressure = $request->get('pressure');
            $usage->heatquality = $request->get('heatquality');
            $usage->enthalpy = $request->get('enthalpy');
            $usage->heatusage = $request->get('heatusage');

            if($usage->enthalpy == 0 && $usage->heatusage == 0){
                return response()->json(['status'=>'fail', 'error'=>'焓值和供热量必须填写一个']);
            }
            if($usage->enthalpy == 0){
                $usage->enthalpy = sprintf("%.4f" , $usage->heatusage * 1000 / $usage->heatquality + 83.74);
            }
            if($usage->heatusage == 0){
                $usage->heatusage = sprintf("%.4f" , $usage->heatquality * ($usage->enthalpy - 83.74) / 1000 );
            }

            $usage->author = $request->user()->id;
            $usage->save();
            \WeitanLog::log("修改了id=".$id."的热力使用外部证明",$request->user());
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status'=>'fail','error'=>'id 不存在']);
    }

    public function delete(Request $request, $id){
        $store = HeatOuterUsage::find($id);
        if($store != null){
            $store->delete();
            \WeitanLog::log("删除了id=".$id."的热力使用外部证明",$request->user());
            return response()->json(['status'=>'success']);
        }

        return response()->json(['status'=>'fail','error'=>'id 不存在']);
    }

    public function tagerror(TagErrorRequest $request, $id){
        $store = HeatOuterUsage::find($id);
        if($store != null){
            $store->error = $request->get('error');
            $store->errorinfo = $request->get('message');
            $store->save();

            \WeitanLog::log("对id=".$id."的热力使用外部证明标记错误信息：".$store->errorinfo,$request->user());
            return response()->json(['status'=>'success']);
        }

        return response()->json(['status'=>'fail','error'=>'id 不存在']);
    }
}
