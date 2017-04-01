<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePertypeCusagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("pertype_cusages",function(Blueprint $table){
            $table->increments('id');
            $table->date('date');
            $table->string('type'); //能源类型
            $table->double('number'); //使用数量
            $table->double('dwfrl'); //低位发热量
            $table->double('dwrlhtl'); //单位热值含碳量
            $table->double('tyhl'); //碳氧化率
            $table->double('cusage'); //碳排放量
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
        Schema::dropIfExists('pertype_cusages');
    }
}
