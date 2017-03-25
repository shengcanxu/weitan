<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EnergyStore
 *
 * @mixin \Eloquent
 */
class EnergyStore extends Model
{
    public function author(){
        return $this->belongsTo('App\User','author');
    }

}
