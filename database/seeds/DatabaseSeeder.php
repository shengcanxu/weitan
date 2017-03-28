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
        $this->call(EnergyTypeSeeder::class);
        $this->call(EnergyStoreSeeder::class);
        $this->call(EnergyStoreAnalysisSeeder::class);
        $this->call(EnergyUsageSeeder::class);
        Eloquent::reguard();
    }
}
