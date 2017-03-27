<?php

namespace App\Http\Controllers;

use App\Models\Energytype;
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

    public function uploadimage(Request $request){
        if($request->hasFile("image")){
            $image = $request->file("image");
            $uploader = new \UploadImageHelper();
            $uploader->upload($image);
        }
    }
}
