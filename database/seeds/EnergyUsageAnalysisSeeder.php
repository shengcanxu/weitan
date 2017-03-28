<?php

use Illuminate\Database\Seeder;
use App\Models\EnergyUsageAnalysis;

class EnergyUsageAnalysisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EnergyUsageAnalysis::firstOrCreate(array('energy_usage_id'=>1,'device'=>'分析仪', 'method'=>'抽样测量法', 'dwfrl'=>50.179, 'dwrlhtl'=>0.0172, 'tyhl'=>0.98, 'author'=>1));
        EnergyUsageAnalysis::firstOrCreate(array('energy_usage_id'=>2,'device'=>'分析仪', 'method'=>'抽样测量法', 'dwfrl'=>50.179, 'dwrlhtl'=>0.0172, 'tyhl'=>0.98, 'author'=>1));
        EnergyUsageAnalysis::firstOrCreate(array('energy_usage_id'=>3,'device'=>'分析仪', 'method'=>'抽样测量法', 'dwfrl'=>50.179, 'dwrlhtl'=>0.0172, 'tyhl'=>0.98, 'author'=>1));
        EnergyUsageAnalysis::firstOrCreate(array('energy_usage_id'=>3,'device'=>'分析仪', 'method'=>'抽样测量法', 'dwfrl'=>50.179, 'dwrlhtl'=>0.0172, 'tyhl'=>0.98, 'author'=>1));
        EnergyUsageAnalysis::firstOrCreate(array('energy_usage_id'=>3,'device'=>'分析仪', 'method'=>'抽样测量法', 'dwfrl'=>50.179, 'dwrlhtl'=>0.0172, 'tyhl'=>0.98, 'author'=>1));
        EnergyUsageAnalysis::firstOrCreate(array('energy_usage_id'=>4,'device'=>'分析仪', 'method'=>'抽样测量法', 'dwfrl'=>50.179, 'dwrlhtl'=>0.0172, 'tyhl'=>0.98, 'author'=>1));
        EnergyUsageAnalysis::firstOrCreate(array('energy_usage_id'=>4,'device'=>'分析仪', 'method'=>'抽样测量法', 'dwfrl'=>50.179, 'dwrlhtl'=>0.0172, 'tyhl'=>0.98, 'author'=>1));
        EnergyUsageAnalysis::firstOrCreate(array('energy_usage_id'=>5,'device'=>'分析仪', 'method'=>'抽样测量法', 'dwfrl'=>50.179, 'dwrlhtl'=>0.0172, 'tyhl'=>0.98, 'author'=>1));
        EnergyUsageAnalysis::firstOrCreate(array('energy_usage_id'=>5,'device'=>'分析仪', 'method'=>'抽样测量法', 'dwfrl'=>50.179, 'dwrlhtl'=>0.0172, 'tyhl'=>0.98, 'author'=>1));
        EnergyUsageAnalysis::firstOrCreate(array('energy_usage_id'=>6,'device'=>'分析仪', 'method'=>'抽样测量法', 'dwfrl'=>50.179, 'dwrlhtl'=>0.0172, 'tyhl'=>0.98, 'author'=>1));
        EnergyUsageAnalysis::firstOrCreate(array('energy_usage_id'=>7,'device'=>'分析仪', 'method'=>'抽样测量法', 'dwfrl'=>50.179, 'dwrlhtl'=>0.0172, 'tyhl'=>0.98, 'author'=>1));
        EnergyUsageAnalysis::firstOrCreate(array('energy_usage_id'=>8,'device'=>'分析仪', 'method'=>'抽样测量法', 'dwfrl'=>50.179, 'dwrlhtl'=>0.0172, 'tyhl'=>0.98, 'author'=>1));
        EnergyUsageAnalysis::firstOrCreate(array('energy_usage_id'=>9,'device'=>'分析仪', 'method'=>'抽样测量法', 'dwfrl'=>50.179, 'dwrlhtl'=>0.0172, 'tyhl'=>0.98, 'author'=>1));

    }
}
