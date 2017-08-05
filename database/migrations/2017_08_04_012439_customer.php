<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Customer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('customer', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->string('ten');
            $table->string('gender',10);
            $table->string('email',50);
            $table->string('address',100);
            $table->string("phone",20);
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
        Schema::drop('customer');
    }
}
