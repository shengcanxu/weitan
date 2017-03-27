<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnergyStoreAnalysisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("energy_store_analysis",function(Blueprint $table){
            $table->increments('id');
            $table->integer('energy_store_id'); //入厂数据ID
            $table->string('device'); //设备
            $table->string('method'); //分析方法
            $table->double('dwfrl'); //低位发热量
            $table->double('dwrlhtl'); //单位热值含碳量
            $table->double('tyhl'); //碳氧化率
            $table->integer('author'); //录入人员
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
        Schema::dropIfExists('energy_store_analysis');
    }
}
