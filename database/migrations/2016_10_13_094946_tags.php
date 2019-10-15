<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tags extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         // Schema::create('tags', function(Blueprint $table){

             // $table->increments('id');
             // $table->integer('user_id');
             // $table->string('name', 64);

         // });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
        // Schema::drop('tags');
     }
}
