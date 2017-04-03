<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\EnergyStore
 *
 * @mixin \Eloquent
 */
class ProcedureUsage extends Model
{
    use SoftDeletes;

    public function procedurestore(){
        return $this->belongsTo('App\Models\EnergyStore','procedurestore');
    }

    public function author(){
        return $this->belongsTo('App\User','author');
    }
}
