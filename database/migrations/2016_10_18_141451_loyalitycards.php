<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Loyalitycards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('loyalty_cards', function(Blueprint $table){
            // $table->increments('id');
            // $table->integer('user_id');
            // $table->integer('company_id');
            // $table->string('image', 100);
            // $table->string('comment', 256);
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
        //Schema::drop("loyalty_cards");
    }
}
