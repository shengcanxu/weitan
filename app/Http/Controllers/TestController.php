<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\User;

class TestController extends Controller
{
    public function  index2(){
        return view('test');
    }

    public function  energystoretest(){
        return view("energystoretest");
    }

    public function energyusagetest(){
        return view("energyusagetest");
    }
}
