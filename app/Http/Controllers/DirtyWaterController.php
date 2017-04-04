<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DirtyWater;
use App\Http\Requests\DirtyWaterRequest;
use App\Http\Requests\TagErrorRequest;

class DirtyWaterController extends Controller
{
    public function index(Request $request){
        $items = DirtyWater::paginate(20);

        $items->load('author');
        $itemsArray = [];
        foreach ($items as $item){
            $item->author = $item->author()->first()->name;
            array_push($itemsArray, $item->attributesToArray());
        }
        return response()->json($itemsArray);
    }

    public function store(DirtyWaterRequest $request){
        $usage = new DirtyWater();
        $usage->date = $request->get('date');
        $usage->mount = $request->get('mount');
        $usage->incod = $request->get('incod');
        $usage->outcod = $request->get('outcod');
        $usage->kgcod = $request->get('kgcod');
        $usage->kgch4 = $request->get('kgch4');
        $usage->jwxzyz = $request->get('jwxzyz');

        $usage->author = $request->user()->id;
        $usage->save();

        \WeitanLog::log("新建了id=".$usage->id."的废水厌氧处理排放",$request->user());
        return response()->json(['status'=>'success','id'=>$usage->id]);
    }

    public function change(DirtyWaterRequest $request, $id){
        $usage = DirtyWater::find($id);
        if($usage != null) {
            $usage->date = $request->get('date');
            $usage->mount = $request->get('mount');
            $usage->incod = $request->get('incod');
            $usage->outcod = $request->get('outcod');
            $usage->kgcod = $request->get('kgcod');
            $usage->kgch4 = $request->get('kgch4');
            $usage->jwxzyz = $request->get('jwxzyz');

            $usage->author = $request->user()->id;
            $usage->save();
            \WeitanLog::log("修改了id=".$id."的废水厌氧处理排放",$request->user());
            return response()->json(['status' => 'success']);
        }

        return response()->json(['status'=>'fail','error'=>'id 不存在']);
    }

    public function delete(Request $request, $id){
        $store = DirtyWater::find($id);
        if($store != null){
            $store->delete();
            \WeitanLog::log("删除了id=".$id."的废水厌氧处理排放",$request->user());
            return response()->json(['status'=>'success']);
        }

        return response()->json(['status'=>'fail','error'=>'id 不存在']);
    }

    public function tagerror(TagErrorRequest $request, $id){
        $store = DirtyWater::find($id);
        if($store != null){
            $store->error = $request->get('error');
            $store->errorinfo = $request->get('message');
            $store->save();

            \WeitanLog::log("对id=".$id."的废水厌氧处理排放标记错误信息：".$store->errorinfo,$request->user());
            return response()->json(['status'=>'success']);
        }

        return response()->json(['status'=>'fail','error'=>'id 不存在']);
    }
}
