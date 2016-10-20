<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('retailer_id')->unsigned();
            $table->foreign('retailer_id')->references('id')->on('retailers');
            $table->string('country')->nullable();
            $table->string('country_slug')->nullable();
            $table->string('country_code')->nullable();
            $table->string('state')->nullable();
            $table->string('state_slug')->nullable();
            $table->string('city')->nullable();
            $table->string('city_slug')->nullable();
            $table->string('street_number')->nullable();
            $table->string('street_address')->nullable();
            $table->string('street_address_slug')->nullable();
            $table->string('postcode')->nullable();
            $table->string('postcode_slug')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('storefront_lg')->nullable();
            $table->string('storefront_md')->nullable();
            $table->string('storefront_sm')->nullable();
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
        Schema::drop('locations');
    }

}