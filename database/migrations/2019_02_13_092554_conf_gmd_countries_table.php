<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConfGmdCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CONF_GMD_COUNTRIES_TABLE', function (Blueprint $table) {
			$table->increments('id');
			$table->string('country');
			$table->string('A2_ISO');
			$table->string('A3_UN');
			$table->string('NUM_UN');
			$table->string('Dialing_code');
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
        //
    }
}
