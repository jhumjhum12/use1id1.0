<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Relationships extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Schema::create('contacts', function(Blueprint $table){
            // $table->increments('id');
            // $table->integer('user_1');
            // $table->integer('user_2');
            // $table->tinyInteger('status');
            // $table->string('user_1_shares',120)->nullable();
            // $table->string('user_2_shares',120)->nullable();
            // $table->index('user_1');
            // $table->index('user_2');
            // $table->timestamps();
        // });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       // Schema::drop('contacts');
    }
}
