<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExportsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exports', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('brand_id')->unsigned()->unique();
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->json('csv_import');
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
        Schema::drop('exports');
    }

}
