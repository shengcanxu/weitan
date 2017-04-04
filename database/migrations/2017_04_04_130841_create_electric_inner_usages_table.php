<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElectricInnerUsagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("electric_inner_usages",function(Blueprint $table){
            $table->increments('id');
            $table->date('month'); //月份
            $table->string('producetype'); //生产工序
            $table->string('devicename'); //电表名称
            $table->double('lastnumber'); //上月行码
            $table->double('currentnumber'); //本月行码
            $table->double('times'); //倍率
            $table->double('usagenumber'); //电表电量
            $table->integer('author'); //录入人员
            $table->boolean('error')->nullable()->default(false); //是否有错误
            $table->string('errorinfo',10000)->nullable(); //错误信息
            $table->timestamps(); //抄表时间
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
        Schema::dropIfExists('electric_inner_usages');
    }
}
