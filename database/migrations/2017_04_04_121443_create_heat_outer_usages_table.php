<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHeatOuterUsagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("heat_outer_usages",function(Blueprint $table){
            $table->increments('id');
            $table->date('month'); //月份
            $table->string('datasource'); //数据来源
            $table->double('temperature'); //温度
            $table->double('pressure'); //压力
            $table->double('heatquality'); //蒸汽质量
            $table->double('enthalpy')->default(0.0); //热焓
            $table->double('heatusage')->default(0.0); //用热量
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
        Schema::dropIfExists('heat_outer_usages');
    }
}
