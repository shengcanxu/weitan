<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnergyStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("energy_stores",function(Blueprint $table){
            $table->increments('id');
            $table->date('storedate'); //入厂时间
            $table->string('type'); //能源类型
            $table->string('batchno')->unique(); //批次号
            $table->integer('number'); //入厂数量
            $table->integer('author'); //录入人员
            $table->boolean('analysis')->default(false); //是否化验
            $table->boolean('error')->nullable()->default(false); //是否有错误
            $table->string('errorinfo',10000)->nullable(); //错误信息
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
        Schema::dropIfExists('energy_stores');
    }
}
