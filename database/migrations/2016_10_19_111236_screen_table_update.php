<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ScreenTableUpdate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('screen', function ($table) {
            // $table->text('help_label', 64)->nullable();
            // $table->string('help_video_url',255)->nullable();
            // $table->text('help_html',255)->nullable();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('users', function ($table) {
            // $table->dropColumn('help_label');
            // $table->dropColumn('help_video_url');
            // $table->dropColumn('help_html');
        // });
    }
}
