<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Companies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('companies', function(Blueprint $table){

            // $table->increments('id');
            // $table->integer('user_id');
            // $table->string('name', 100);
            // $table->string('registration_number', 50)->nullable();
            // $table->string('website', 100)->nullable();
            // $table->string('logo', 64)->nullable();
            // $table->integer('reference')->nullable();
        // });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       // Schema::drop('companies');
    }
}
