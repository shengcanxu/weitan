<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\EnergyStore
 *
 * @mixin \Eloquent
 */
class ElectricInnerUsage extends Model
{
    use SoftDeletes;

    public function author(){
        return $this->belongsTo('App\User','author');
    }
}
