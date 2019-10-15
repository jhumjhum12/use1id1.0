<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Revisions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('revisions', function(Blueprint $table){

            // $table->increments('id');
            // $table->string('user_id', 16);
            // $table->integer('resource_id');
            // $table->tinyInteger('type');
            // $table->string('name', 255);
            // $table->text('text');
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
        //Schema::drop('revisions');
    }
}
