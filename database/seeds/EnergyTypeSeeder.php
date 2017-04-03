<?php

use Illuminate\Database\Seeder;
use App\Models\Energytype;

class EnergyTypeSeeder extends Seeder
{
    /**
 * Run the database seeds.
 *
 * @return void
 */
    public function run()
    {

        Energytype::firstOrCreate(array('name'=>'无烟煤'));
        Energytype::firstOrCreate(array('name'=>'烟煤'));
        Energytype::firstOrCreate(array('name'=>'原油'));
        Energytype::firstOrCreate(array('name'=>'汽油'));
    }
}
