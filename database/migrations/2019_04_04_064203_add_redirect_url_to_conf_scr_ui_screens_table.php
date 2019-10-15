<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRedirectUrlToConfScrUiScreensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('conf_scr_ui_screens', function (Blueprint $table) {
            $table->string('redirect_url',255)->after('first_screen');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::table('conf_scr_ui_screens', function (Blueprint $table) {
            //
        //});
    }
}
