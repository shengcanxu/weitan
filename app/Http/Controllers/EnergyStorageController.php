<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnergyStorageController extends Controller
{
    public function enerageusage(Request $request){

    }

    public function cusage(){
        $results = DB::select("select date_format(date,'%Y%m') as months, sum(number) as totalnum, avg(dwfrl) as totaldwfrl, avg(dwrlhtl) as totaldwrlhtl, avg(tyhl) as totaltyhl, sum(cusage) as totalusage from pertype_cusages group by months");
        return response()->json($results);
    }
}
