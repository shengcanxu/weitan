<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProcedureStoreAnalysisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("procedure_store_analysis",function(Blueprint $table){
            $table->increments('id');
            $table->integer('procedure_store_id'); //入厂数据ID
            $table->string('device'); //设备
            $table->string('method'); //分析方法
            $table->double('pfyz'); //二氧化碳排放因子
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
        Schema::dropIfExists('procedure_store_analysis');
    }
}
