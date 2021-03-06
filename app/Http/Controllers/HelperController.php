<?php

namespace App\Http\Controllers;

use App\Models\Energytype;
use App\Models\EnergyUsageDefault;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HelperController extends Controller
{
    public function token(){
        return response()->json(['token' => csrf_token()], 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function energytypes(){
        $energyTypes = DB::table("energy_types")->pluck('name');
        return response()->json($energyTypes);
    }

    public function materialtypes(){
        $materialTypes = DB::table("material_types")->pluck('name');
        return response()->json($materialTypes);
    }

    public function heatProduceTypes(){
        $types = DB::table("heat_produce_types")->pluck('name');
        return response()->json($types);
    }

    public function heatdatasource(){
        $sources = DB::table("heat_datasource")->pluck('name');
        return response()->json($sources);
    }

    public function electricproducetypes(){
        $types = DB::table("electric_produce_types")->pluck('name');
        return response()->json($types);
    }

    public function uploadimage(Request $request){
        if($request->hasFile("image")){
            $image = $request->file("image");
            $uploader = new \UploadImageHelper();
            $uploader->upload($image);
        }
    }

    public function energyusagedefaults(){
        $defaults = EnergyUsageDefault::all();
        $result = [];
        foreach ($defaults as $default){
            array_push($result, $default->attributesToArray());
        }
        return response()->json($result);
    }

    public function energyusagedefault($type){
        $default = EnergyUsageDefault::where('type', '=', $type)->get();
        if($default != null){
            return response()->json($default);
        }else{
            return response()->json([]);
        }
    }
}
