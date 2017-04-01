<?php

use Illuminate\Database\Seeder;
use App\Models\EnergyUsage;

class EnergyUsageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EnergyUsage::firstOrCreate(array('usagedate'=>'2017-01-11','energystore'=>1,'type'=>'烟煤','number'=>123,'author'=>1));
        EnergyUsage::firstOrCreate(array('usagedate'=>'2017-01-11','energystore'=>1,'type'=>'无烟煤','number'=>3,'author'=>1));
        EnergyUsage::firstOrCreate(array('usagedate'=>'2017-01-11','energystore'=>1,'type'=>'烟煤','number'=>12,'author'=>1));
        EnergyUsage::firstOrCreate(array('usagedate'=>'2017-01-11','energystore'=>1,'type'=>'无烟煤','number'=>13,'author'=>1));
        EnergyUsage::firstOrCreate(array('usagedate'=>'2017-01-13','energystore'=>1,'type'=>'烟煤','number'=>23,'author'=>1));
        EnergyUsage::firstOrCreate(array('usagedate'=>'2017-01-13','energystore'=>1,'type'=>'无烟煤','number'=>1323,'author'=>1));
    }
}
