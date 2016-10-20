<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemplatesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('templates', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('brand_id');
            $table->string('template_name')->nullable();
            $table->string('settings_schema')->nullable();
            //$table->string('scss')->nullable();
            //$table->string('js_core')->nullable();
            //$table->string('js_components')->nullable();
            //$table->string('skeleton')->nullable();
            //$table->string('header')->nullable();
            //$table->string('main')->nullable();
            //$table->string('footer')->nullable();
            //$table->string('navigation')->nullable();
            //$table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('retailers');
    }

}