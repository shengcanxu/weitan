<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\EnergyStore
 *
 * @mixin \Eloquent
 */
class EnergyUsage extends Model
{
    use SoftDeletes;

    public function energystore(){
        return $this->belongsTo('App\Models\EnergyStore','energystore');
    }

    public function author(){
        return $this->belongsTo('App\User','author');
    }
}
