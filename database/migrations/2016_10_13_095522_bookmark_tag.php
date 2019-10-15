<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BookmarkTag extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         // Schema::create('bookmark_tag', function(Blueprint $table){

             // $table->increments('id');
             // $table->integer('bookmark_id');
             // $table->integer('tag_id');

         // });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         //Schema::drop('bookmark_tag');
     }
}
