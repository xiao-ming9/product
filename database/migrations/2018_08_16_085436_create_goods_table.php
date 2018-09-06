<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('type_id')->nullable();
            $table->integer('secondtype_id')->nullable();
            $table->integer('thirdtype_id')->nullable();
            $table->string('brand')->nullable();
            $table->string('shape')->nullable();
            $table->string('capacity')->nullable();
            $table->string('category')->nullable();
            $table->string('characteristic')->nullable();
            $table->string('standard')->nullable();
            $table->string('img')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods');
    }
}
