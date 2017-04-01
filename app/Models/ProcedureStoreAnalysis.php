<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\EnergyStore
 *
 * @mixin \Eloquent
 */
class ProcedureStoreAnalysis extends Model
{
    use SoftDeletes;

    protected $table = 'procedure_store_analysis';
}
