<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("procedure_stores",function(Blueprint $table){
            $table->increments('id');
            $table->date('storedate'); //入厂时间
            $table->string('type'); //物料类型
            $table->string('batchno')->unique(); //批次号
            $table->double('number'); //入厂数量
            $table->integer('usage')->default(0); //使用量
            $table->integer('remain')->default(0); //剩余数量
            $table->integer('author'); //录入人员
            $table->boolean('analysis')->default(false); //是否已化验
            $table->double('pfyz')->default(0.0); //二氧化碳排放因子
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
        Schema::dropIfExists('procedure_stores');
    }
}
