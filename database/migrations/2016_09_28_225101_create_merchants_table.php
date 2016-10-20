<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchants', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('brand_id')->unsigned()->unique();
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->json('merchants');
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
        Schema::drop('merchants');
    }

}