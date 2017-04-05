<?php

use App\Models\OperationLog;
use App\Models\TagError;

class WeitanHelper
{
    public static function log($message,$user){
        $log = new OperationLog();
        $log->logmsg = $user->name.$message;
        $log->user_id = $user->id;
        $log->save();
    }

    public static function reportError($place, $message, $ownerid, $reporterid){
        $error = new TagError();
        $error->place = $place;
        $error->errorinfo = $message;
        $error->owner = $ownerid;
        $error->reporter = $reporterid;
        $error->save();
    }
}