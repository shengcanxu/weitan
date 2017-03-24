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
        $energyTypes = DB::table("energytypes")->pluck('name');
        return response()->json($energyTypes);

    }
}
