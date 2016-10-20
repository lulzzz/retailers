<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRetailersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retailers', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('brand_id');
            $table->string('type')->nullable();
            $table->string('name')->nullable();
            $table->string('featured')->default('hidden');
            $table->string('visibility')->default('hidden');;
            $table->text('description')->nullable();
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('slug')->nullable();
            $table->string('logo_lg')->nullable();
            $table->string('logo_md')->nullable();
            $table->string('logo_sm')->nullable();
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
        Schema::drop('retailers');
    }

}