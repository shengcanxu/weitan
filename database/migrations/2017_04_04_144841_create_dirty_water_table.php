<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDirtyWaterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("dirty_water",function(Blueprint $table){
            $table->increments('id');
            $table->date('date'); //时间
            $table->double('mount'); //厌氧处理系统废水量
            $table->double('incod'); //厌氧处理系统进水口COD
            $table->double('outcod'); //厌氧处理系统出水口COD
            $table->double('kgcod'); //污泥去除有机物
            $table->double('kgch4'); //甲烷回收量
            $table->double('jwxzyz')->default(0.5); //甲烷修正因子
            $table->integer('author'); //录入人员
            $table->boolean('error')->nullable()->default(false); //是否有错误
            $table->string('errorinfo',10000)->nullable(); //错误信息
            $table->timestamps(); //时间
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
        Schema::dropIfExists('dirty_water');
    }
}
