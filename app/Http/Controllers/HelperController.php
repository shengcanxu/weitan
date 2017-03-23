<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelperController extends Controller
{
    public function token(){
        return response()->json(['token' => csrf_token()], 200);
    }
}
