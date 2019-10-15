<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Invitations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('invitations', function(Blueprint $table){
            // $table->increments('id');
            // $table->integer('inviter_id');
            // $table->string('code', 64);
            // $table->string('email', 64);
            // $table->tinyInteger('status');
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
        //Schema::drop('invitations');
    }
}
