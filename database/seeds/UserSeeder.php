<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::firstOrCreate(array('name'=>'cano','phone'=>'18565129949','password'=>'$2y$10$yCCglQfX8lmS0OdBPA7oBOil.vDdSd4nuUueL.gISTGXGhQTdC8li'));
    }
}
