<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SavedPasswords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('saved_passwords', function (Blueprint $table) {
            // $table->increments('id');
            // $table->integer('user_id');
			// $table->string('url', 255);
			// $table->string('name', 128);
            // $table->string('username', 128)->nullable();
            // $table->string('password', 512)->nullable();
			// $table->text('other_fields')->nullable();
			// $table->text('notes')->nullable();
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
        //Schema::dropIfExists('saved_passwords');
    }
}
