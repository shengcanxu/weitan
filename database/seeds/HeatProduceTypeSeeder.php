<?php

use Illuminate\Database\Seeder;
use App\Models\HeatProduceType;

class HeatProduceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HeatProduceType::firstOrCreate(array('name'=>'纸浆制造'));
        HeatProduceType::firstOrCreate(array('name'=>'机制纸及纸板制造'));
        HeatProduceType::firstOrCreate(array('name'=>'纸制品制造'));
        HeatProduceType::firstOrCreate(array('name'=>'非生产用热'));
        HeatProduceType::firstOrCreate(array('name'=>'自产供热量'));
        HeatProduceType::firstOrCreate(array('name'=>'外销热力'));
        HeatProduceType::firstOrCreate(array('name'=>'其他工序'));
    }
}
