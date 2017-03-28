<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EnergyStore
 *
 * @mixin \Eloquent
 */
class OperationLog extends Model
{
    public function author(){
        return $this->belongsTo('App\User','user_id');
    }
}
