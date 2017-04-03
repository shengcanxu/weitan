<?php

use Illuminate\Database\Seeder;
use App\Models\ProcedureStore;

class ProcedureStoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProcedureStore::firstOrCreate(array('storedate'=>'2017-01-11','type'=>'石灰石','batchno'=>'L001','number' =>300000,'remain'=>3, 'author'=>1));
        ProcedureStore::firstOrCreate(array('storedate'=>'2017-03-11','type'=>'纸张','batchno'=>'L002','number' => 123, 'remain'=>3,'author'=>1));
        ProcedureStore::firstOrCreate(array('storedate'=>'2017-05-11','type'=>'石灰石','batchno'=>'L003','number' => 123, 'remain'=>3,'author'=>1));
        ProcedureStore::firstOrCreate(array('storedate'=>'2017-03-11','type'=>'纸张','batchno'=>'L004','number' => 1233, 'remain'=>3,'author'=>1));
        ProcedureStore::firstOrCreate(array('storedate'=>'2017-05-11','type'=>'石灰石','batchno'=>'L005','number' => 12, 'remain'=>3,'author'=>1));
        ProcedureStore::firstOrCreate(array('storedate'=>'2017-03-11','type'=>'石灰石','batchno'=>'L006','number' => 123, 'remain'=>3,'author'=>1));
        ProcedureStore::firstOrCreate(array('storedate'=>'2017-03-11','type'=>'纸张','batchno'=>'L007','number' => 123,'remain'=>3, 'author'=>1));
        ProcedureStore::firstOrCreate(array('storedate'=>'2017-05-11','type'=>'石灰石','batchno'=>'L008','number' => 123, 'remain'=>3,'author'=>1));
        ProcedureStore::firstOrCreate(array('storedate'=>'2017-03-11','type'=>'石灰石','batchno'=>'L009','number' => 3, 'remain'=>3,'author'=>1));
        ProcedureStore::firstOrCreate(array('storedate'=>'2017-03-11','type'=>'石灰石','batchno'=>'L0010','number' => 12, 'remain'=>3,'author'=>1));
        ProcedureStore::firstOrCreate(array('storedate'=>'2017-03-11','type'=>'纸张','batchno'=>'L0011','number' => 23, 'remain'=>3,'author'=>1));
        ProcedureStore::firstOrCreate(array('storedate'=>'2017-03-11','type'=>'石灰石','batchno'=>'L0012','number' => 123,'remain'=>3, 'author'=>1));
        ProcedureStore::firstOrCreate(array('storedate'=>'2017-03-11','type'=>'石灰石','batchno'=>'L0013','number' => 23, 'remain'=>3,'author'=>1));
        ProcedureStore::firstOrCreate(array('storedate'=>'2017-07-11','type'=>'纸张','batchno'=>'L0014','number' => 123,'remain'=>3, 'author'=>1));
        ProcedureStore::firstOrCreate(array('storedate'=>'2017-03-11','type'=>'石灰石','batchno'=>'L0015','number' => 123, 'remain'=>3,'author'=>1));
    }
}
