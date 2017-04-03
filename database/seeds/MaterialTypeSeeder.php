<?php

use Illuminate\Database\Seeder;
use App\Models\MaterialType;

class MaterialTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MaterialType::firstOrCreate(array('name'=>'石灰石'));
        MaterialType::firstOrCreate(array('name'=>'水泥'));
        MaterialType::firstOrCreate(array('name'=>'纸张'));
        MaterialType::firstOrCreate(array('name'=>'柴'));
    }
}
