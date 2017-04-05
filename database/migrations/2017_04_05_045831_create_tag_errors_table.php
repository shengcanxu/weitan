<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagErrorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("tag_errors",function(Blueprint $table){
            $table->increments('id');
            $table->string('place'); //错误位置
            $table->string('errorinfo',10000); //错误信息
            $table->integer('owner'); //错误处理人员
            $table->integer('reporter'); //报告人员
            $table->timestamps(); //创建时间
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag_errors');
    }
}
