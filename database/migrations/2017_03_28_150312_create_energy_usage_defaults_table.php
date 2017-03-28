<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnergyUsageDefaultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("energy_usage_defaults",function(Blueprint $table){
            $table->increments('id');
            $table->string('type'); //能源类型
            $table->double('dwfrl'); //低位发热量
            $table->double('dwrlhtl'); //单位热值含碳量
            $table->double('tyhl'); //碳氧化率
            $table->timestamps(); //录入时间
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('energy_usage_defaults');
    }
}
