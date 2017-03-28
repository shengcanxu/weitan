<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnergyUsageAnalysisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("energy_usage_analysis",function(Blueprint $table){
            $table->increments('id');
            $table->integer('energy_usage_id'); //入炉数据ID
            $table->string('device'); //设备
            $table->string('method'); //分析方法
            $table->double('dwfrl'); //低位发热量
            $table->double('dwrlhtl'); //单位热值含碳量
            $table->double('tyhl'); //碳氧化率
            $table->integer('author'); //录入人员
            $table->boolean('error')->nullable()->default(false); //是否有错误
            $table->string('errorinfo',10000)->nullable(); //错误信息
            $table->timestamps(); //录入时间
            $table->softDeletes(); //删除时间
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('energy_usage_analysis');
    }
}
