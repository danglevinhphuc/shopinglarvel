<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('products', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->string('ten');
            $table->integer('id_category')->unsigned();
            $table->foreign('id_category')->references('id')->on('category')->onDelete('cascade');
            $table->longText('description');
            $table->float('unit_price');
            $table->float(' promotion_price');
            $table->integer('new');
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
        //
        Schema::drop('products');
    }
}
