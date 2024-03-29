<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsActiveToConfGmdCountryTableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('conf_gmd_country_table', function (Blueprint $table) {
            $table->tinyInteger('is_active')->default(1)->after('Dialing_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::table('conf_gmd_country_table', function (Blueprint $table) {
            //
        //});
    }
}
