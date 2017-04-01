<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnergyUsagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("energy_usages",function(Blueprint $table){
            $table->increments('id');
            $table->date('usagedate'); //入炉时间
            $table->integer('energystore'); //入厂信息ID
            $table->string('type'); //能源类型
            $table->double('number'); //入炉数量
            $table->integer('author'); //录入人员
            $table->boolean('analysis')->default(false); //是否已化验
            $table->double('dwfrl')->default(0.0); //低位发热量
            $table->double('dwrlhtl')->default(0.0); //单位热值含碳量
            $table->double('tyhl')->default(0.0); //碳氧化率
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
        Schema::dropIfExists('energy_usages');
    }
}
