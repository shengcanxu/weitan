<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ElectricOuterUsage;
use App\Http\Requests\TagErrorRequest;
use App\Http\Requests\ElectricOuterUsageRequest;

class ElectricOuterUsageController extends Controller
{
    public function index(Request $request){
        $items = ElectricOuterUsage::paginate(20);

        $items->load('author');
        $itemsArray = [];
        foreach ($items as $item){
            $item->author = $item->author()->first()->name;
            array_push($itemsArray, $item->attributesToArray());
        }
        return response()->json($itemsArray);
    }

    public function store(ElectricOuterUsageRequest $request){
        $usage = new ElectricOuterUsage();
        $usage->month = $request->get('month');
        $usage->datasource = $request->get('datasource');
        $usage->usagenumber = $request->get('usagenumber');
        $usage->author = $request->user()->id;
        $usage->save();

        \WeitanLog::log("新建了id=".$usage->id."的电力使用外部记录",$request->user());
        return response()->json(['status'=>'success','id'=>$usage->id]);
    }

    public function change(ElectricOuterUsageRequest $request, $id){
        $usage = ElectricOuterUsage::find($id);
        if($usage != null) {
            $usage->month = $request->get('month');
            $usage->datasource = $request->get('datasource');
            $usage->usagenumber = $request->get('usagenumber');
            $usage->author = $request->user()->id;
            $usage->save();

            \WeitanLog::log("修改了id=".$id."的电力使用外部记录",$request->user());
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status'=>'fail','error'=>'id 不存在']);
    }

    public function delete(Request $request, $id){
        $store = ElectricOuterUsage::find($id);
        if($store != null){
            $store->delete();
            \WeitanLog::log("删除了id=".$id."的电力使用外部记录",$request->user());
            return response()->json(['status'=>'success']);
        }

        return response()->json(['status'=>'fail','error'=>'id 不存在']);
    }

    public function tagerror(TagErrorRequest $request, $id){
        $store = ElectricOuterUsage::find($id);
        if($store != null){
            $store->error = $request->get('error');
            $store->errorinfo = $request->get('message');
            $store->save();

            \WeitanLog::log("对id=".$id."的电力使用外部记录标记错误信息：".$store->errorinfo,$request->user());
            return response()->json(['status'=>'success']);
        }

        return response()->json(['status'=>'fail','error'=>'id 不存在']);
    }
}
