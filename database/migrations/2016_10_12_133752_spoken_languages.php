<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SpokenLanguages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('spoken_languages', function(Blueprint $table){

            // $table->increments('id');
            // $table->string('user_id', 16);
            // $table->integer('languages_list_id');
            // $table->string('listening',255)->nullable();
            // $table->string('speaking',255)->nullable();
            // $table->string('reading',255)->nullable();
            // $table->string('writing',255)->nullable();

        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       // Schema::drop('spoken_languages');
    }
}
