<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElectricOuterUsagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("electric_outer_usages",function(Blueprint $table){
            $table->increments('id');
            $table->date('month'); //月份
            $table->string('datasource'); //数据来源
            $table->double('usagenumber'); //用量
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
        Schema::dropIfExists('electric_outer_usages');
    }
}
