<?php

use Illuminate\Database\Seeder;
use App\Models\HeatDatasource;

class HeatDatasourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HeatDatasource::firstOrCreate(array('name'=>'结算单'));
        HeatDatasource::firstOrCreate(array('name'=>'发票'));
        HeatDatasource::firstOrCreate(array('name'=>'其他凭证'));
    }
}
