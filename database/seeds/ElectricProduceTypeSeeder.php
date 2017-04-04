<?php

use Illuminate\Database\Seeder;
use App\Models\ElectricProduceType;

class ElectricProduceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ElectricProduceType::firstOrCreate(array('name'=>'纸浆制造'));
        ElectricProduceType::firstOrCreate(array('name'=>'机制纸及纸板制造'));
        ElectricProduceType::firstOrCreate(array('name'=>'纸制品制造'));
        ElectricProduceType::firstOrCreate(array('name'=>'非生产用电'));
        ElectricProduceType::firstOrCreate(array('name'=>'自产供电量'));
        ElectricProduceType::firstOrCreate(array('name'=>'外销电量'));
        ElectricProduceType::firstOrCreate(array('name'=>'其他工序'));
    }
}
