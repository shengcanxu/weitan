<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use App\User;
Use DateTime;
use DateInterval;

class TestController extends Controller
{
    public function  index2(){
        $date = new DateTime('2017-01-01');
        $date = $date->sub(new DateInterval('P1D'));
        var_dump($date);
//        for ($i=0; $i<100; $i++) {
//            $date->add(new DateInterval('P1D'));
//            echo $date->format('Y-m-d') . "\n";
//        }
    }

    public function  energystoretest(){
        return view("energystoretest");
    }

    public function energyusagetest(){
        return view("energyusagetest");
    }

    public function procedurestoretest(){
        return view("procedurestoretest");
    }

    public function procedureusagetest(){
        return view("procedureusagetest");
    }

    public function heattest() {
        return view("heattest");
    }

    public function electrictest(){
        return view("electrictest");
    }

    public function dirtywater(){
        return view("dirtywatertest");
    }
}
