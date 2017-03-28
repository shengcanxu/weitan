<?php

use App\Models\OperationLog;

class WeitanLog
{
    public static function log($message,$user){
        $log = new OperationLog();
        $log->logmsg = $user->name.$message;
        $log->user_id = $user->id;
        $log->save();
    }
}