<?php

use Illuminate\Database\Seeder;
use App\Models\EnergyUsageDefault;

class EnergyUsageDefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EnergyUsageDefault::firstOrCreate(array('type'=>'无烟煤','dwfrl'=>26.7,'dwrlhtl'=>0.0274,'tyhl'=>0.94));
        EnergyUsageDefault::firstOrCreate(array('type'=>'烟煤','dwfrl'=>19.57,'dwrlhtl'=>0.0261,'tyhl'=>0.93));
	    EnergyUsageDefault::firstOrCreate(array('type'=>'褐煤','dwfrl'=>11.9	,'dwrlhtl'=>0.028,'tyhl'=>0.96));
        EnergyUsageDefault::firstOrCreate(array('type'=>'洗精煤','dwfrl'=>26.334,'dwrlhtl'=>0.02541,'tyhl'=>0.9));
        EnergyUsageDefault::firstOrCreate(array('type'=>'其它洗煤','dwfrl'=>12.545,'dwrlhtl'=>0.02541,'tyhl'=>0.9));
        EnergyUsageDefault::firstOrCreate(array('type'=>'其它煤制品','dwfrl'=>17.46,'dwrlhtl'=>0.0336,'tyhl'=>0.9));
        EnergyUsageDefault::firstOrCreate(array('type'=>'石油焦','dwfrl'=>32.5,'dwrlhtl'=>0.0275	,'tyhl'=>1));
        EnergyUsageDefault::firstOrCreate(array('type'=>'焦炭','dwfrl'=>28.435,'dwrlhtl'=>0.0295	,'tyhl'=>0.93));
        EnergyUsageDefault::firstOrCreate(array('type'=>'原油','dwfrl'=>41.816,'dwrlhtl'=>0.0201,'tyhl'=>0.98));
        EnergyUsageDefault::firstOrCreate(array('type'=>'燃料油','dwfrl'=>41.816,'dwrlhtl'=>0.0211,'tyhl'=>0.98));
        EnergyUsageDefault::firstOrCreate(array('type'=>'汽油	','dwfrl'=>43.07,'dwrlhtl'=>0.0189,'tyhl'=>0.98));
        EnergyUsageDefault::firstOrCreate(array('type'=>'柴油','dwfrl'=>42.652,'dwrlhtl'=>0.0202,'tyhl'=>0.98));
        EnergyUsageDefault::firstOrCreate(array('type'=>'煤油','dwfrl'=>43.07,'dwrlhtl'=>0.0196,'tyhl'=>0.98));
        EnergyUsageDefault::firstOrCreate(array('type'=>'液化天然气','dwfrl'=>44.2,'dwrlhtl'=>0.0172,'tyhl'=>0.98));
        EnergyUsageDefault::firstOrCreate(array('type'=>'液化石油气','dwfrl'=>50.179,'dwrlhtl'=>0.0172,'tyhl'=>0.98));
        EnergyUsageDefault::firstOrCreate(array('type'=>'炼厂干气','dwfrl'=>45.998,'dwrlhtl'=>0.0182,'tyhl'=>0.98));
        EnergyUsageDefault::firstOrCreate(array('type'=>'焦油','dwfrl'=>33.453,'dwrlhtl'=>0.022,'tyhl'=>0.98));
        EnergyUsageDefault::firstOrCreate(array('type'=>'焦炉煤气','dwfrl'=>179.81,'dwrlhtl'=>0.01358,'tyhl'=>0.99));
        EnergyUsageDefault::firstOrCreate(array('type'=>'高炉煤气','dwfrl'=>33,'dwrlhtl'=>0.0708,'tyhl'=>0.99));
        EnergyUsageDefault::firstOrCreate(array('type'=>'转炉煤气','dwfrl'=>84,'dwrlhtl'=>0.0496,'tyhl'=>0.99));
        EnergyUsageDefault::firstOrCreate(array('type'=>'其它煤气','dwfrl'=>52.27,'dwrlhtl'=>0.0122,'tyhl'=>0.99));
        EnergyUsageDefault::firstOrCreate(array('type'=>'天然气','dwfrl'=>389.31,'dwrlhtl'=>0.0153,'tyhl'=> 0.99));
    }
}
