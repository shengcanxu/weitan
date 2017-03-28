<?php

use Illuminate\Database\Seeder;
use App\Models\EnergyStore;

class EnergyStoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EnergyStore::firstOrCreate(array('storedate'=>'2017-01-11','type'=>'烟煤','batchno'=>'L001','number' => 3, 'author'=>1));
        EnergyStore::firstOrCreate(array('storedate'=>'2017-03-11','type'=>'烟煤','batchno'=>'L002','number' => 123, 'author'=>1));
        EnergyStore::firstOrCreate(array('storedate'=>'2017-05-11','type'=>'烟煤','batchno'=>'L003','number' => 123, 'author'=>1));
        EnergyStore::firstOrCreate(array('storedate'=>'2017-03-11','type'=>'烟煤','batchno'=>'L004','number' => 1233, 'author'=>1));
        EnergyStore::firstOrCreate(array('storedate'=>'2017-05-11','type'=>'烟煤','batchno'=>'L005','number' => 12, 'author'=>1));
        EnergyStore::firstOrCreate(array('storedate'=>'2017-03-11','type'=>'烟煤','batchno'=>'L006','number' => 123, 'author'=>1));
        EnergyStore::firstOrCreate(array('storedate'=>'2017-03-11','type'=>'烟煤','batchno'=>'L007','number' => 123, 'author'=>1));
        EnergyStore::firstOrCreate(array('storedate'=>'2017-05-11','type'=>'烟煤','batchno'=>'L008','number' => 123, 'author'=>1));
        EnergyStore::firstOrCreate(array('storedate'=>'2017-03-11','type'=>'烟煤','batchno'=>'L009','number' => 3, 'author'=>1));
        EnergyStore::firstOrCreate(array('storedate'=>'2017-03-11','type'=>'烟煤','batchno'=>'L0010','number' => 12, 'author'=>1));
        EnergyStore::firstOrCreate(array('storedate'=>'2017-03-11','type'=>'烟煤','batchno'=>'L0011','number' => 23, 'author'=>1));
        EnergyStore::firstOrCreate(array('storedate'=>'2017-03-11','type'=>'烟煤','batchno'=>'L0012','number' => 123, 'author'=>1));
        EnergyStore::firstOrCreate(array('storedate'=>'2017-03-11','type'=>'烟煤','batchno'=>'L0013','number' => 23, 'author'=>1));
        EnergyStore::firstOrCreate(array('storedate'=>'2017-07-11','type'=>'烟煤','batchno'=>'L0014','number' => 123, 'author'=>1));
        EnergyStore::firstOrCreate(array('storedate'=>'2017-03-11','type'=>'烟煤','batchno'=>'L0015','number' => 123, 'author'=>1));
    }
}
