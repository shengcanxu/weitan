<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ElectricInnerUsage;
use App\Http\Requests\ElectricInnerUsageRequest;
use App\Http\Requests\TagErrorRequest;

class ElectricInnerUsageController extends Controller
{
    public function index(Request $request){
        $items = ElectricInnerUsage::paginate(20);

        $items->load('author');
        $itemsArray = [];
        foreach ($items as $item){
            $item->author = $item->author()->first()->name;
            array_push($itemsArray, $item->attributesToArray());
        }
        return response()->json($itemsArray);
    }

    public function store(ElectricInnerUsageRequest $request){
        $usage = new ElectricInnerUsage();
        $usage->month = $request->get('month');
        $usage->producetype = $request->get('producetype');
        $usage->devicename = $request->get('devicename');
        $usage->lastnumber = $request->get('lastnumber');
        $usage->currentnumber = $request->get('currentnumber');
        if($usage->currentnumber < $usage->lastnumber){
            return response()->json(['status'=>'fail', 'error'=>'本月行码不能少于上月行码']);
        }

        $usage->times = $request->get('times');
        $usage->usagenumber = ($usage->currentnumber - $usage->lastnumber) * $usage->times;

        $usage->author = $request->user()->id;
        $usage->save();

        \WeitanHelper::log("新建了id=".$usage->id."的电力使用内部记录",$request->user());
        return response()->json(['status'=>'success','id'=>$usage->id]);
    }

    public function change(ElectricInnerUsageRequest $request, $id){
        $usage = ElectricInnerUsage::find($id);
        if($usage != null) {
            $usage->month = $request->get('month');
            $usage->producetype = $request->get('producetype');
            $usage->devicename = $request->get('devicename');
            $usage->lastnumber = $request->get('lastnumber');
            $usage->currentnumber = $request->get('currentnumber');
            if($usage->currentnumber < $usage->lastnumber){
                return response()->json(['status'=>'fail', 'error'=>'本月行码不能少于上月行码']);
            }

            $usage->times = $request->get('times');
            $usage->usagenumber = ($usage->currentnumber - $usage->lastnumber) * $usage->times;

            $usage->author = $request->user()->id;
            $usage->save();
            \WeitanHelper::log("修改了id=".$id."的电力使用内部记录",$request->user());
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status'=>'fail','error'=>'id 不存在']);
    }

    public function delete(Request $request, $id){
        $store = ElectricInnerUsage::find($id);
        if($store != null){
            $store->delete();
            \WeitanHelper::log("删除了id=".$id."的电力使用内部记录",$request->user());
            return response()->json(['status'=>'success']);
        }

        return response()->json(['status'=>'fail','error'=>'id 不存在']);
    }

    public function tagerror(TagErrorRequest $request, $id){
        $store = ElectricInnerUsage::find($id);
        if($store != null){
            $store->error = $request->get('error');
            $store->errorinfo = $request->get('message');
            $store->save();

            \WeitanHelper::log("对id=".$id."的电力使用内部记录标记错误信息：".$store->errorinfo,$request->user());
            \WeitanHelper::reportError("电力使用内部记录", $store->errorinfo, $store->author, $request->user()->id );
            return response()->json(['status'=>'success']);
        }

        return response()->json(['status'=>'fail','error'=>'id 不存在']);
    }
}
