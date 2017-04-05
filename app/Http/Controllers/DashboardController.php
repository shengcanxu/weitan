<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OperationLog; 
use App\Models\TagError; 

class DashboardController extends Controller
{
    public function index(Request $request){
         $logs = $this->operationlog($request);
         $errors = $this->tagerror($request);

         return [
             'permissions'=>[],
             'operationlogs' =>$logs,
             'errors' => $errors,
         ];
        
    }
    
    private function operationlog(Request $request){
        $logs = OperationLog::where('user_id', '=', $request->user()->id)->paginate(20); 
        return $logs; 
    }
    
    private function tagerror(Request $request){
        $errors = TagError::where('owner', '=', $request->user()->id)->paginate(20); 
        return $errors; 
    }
}
