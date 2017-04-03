<?php

use Illuminate\Database\Seeder;
use App\Models\ProcedureUsage;

class ProcedureUsageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProcedureUsage::firstOrCreate(array('usagedate'=>'2017-01-11','procedurestore'=>1,'type'=>'石灰石','number'=>123,'author'=>1));
        ProcedureUsage::firstOrCreate(array('usagedate'=>'2017-01-11','procedurestore'=>1,'type'=>'纸张','number'=>3,'author'=>1));
        ProcedureUsage::firstOrCreate(array('usagedate'=>'2017-01-11','procedurestore'=>1,'type'=>'石灰石','number'=>12,'author'=>1));
        ProcedureUsage::firstOrCreate(array('usagedate'=>'2017-01-11','procedurestore'=>1,'type'=>'纸张','number'=>13,'author'=>1));
        ProcedureUsage::firstOrCreate(array('usagedate'=>'2017-01-13','procedurestore'=>1,'type'=>'石灰石','number'=>23,'author'=>1));
        ProcedureUsage::firstOrCreate(array('usagedate'=>'2017-01-13','procedurestore'=>1,'type'=>'纸张','number'=>1323,'author'=>1));
    }
}
