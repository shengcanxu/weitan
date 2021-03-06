<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        $this->call(UserSeeder::class);
        $this->call(EnergyTypeSeeder::class);
        $this->call(EnergyStoreSeeder::class);
        $this->call(EnergyStoreAnalysisSeeder::class);
        $this->call(EnergyUsageSeeder::class);
        $this->call(EnergyUsageAnalysisSeeder::class);
        $this->call(EnergyUsageDefaultSeeder::class);

        //$this->call(AreaSeeder::class);
        $this->call(MaterialTypeSeeder::class);
        $this->call(ProcedureStoreSeeder::class);
        $this->call(ProcedureUsageSeeder::class);
        $this->call(HeatProduceTypeSeeder::class);
        $this->call(HeatDatasourceSeeder::class);

        $this->call(ElectricProduceTypeSeeder::class);
        Eloquent::reguard();
    }
}
