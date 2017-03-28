<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\EnergyStore
 *
 * @mixin \Eloquent
 */
class EnergyStoreAnalysis extends Model
{
    use SoftDeletes;

    protected $table = 'energy_store_analysis';

}
