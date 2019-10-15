<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConfScrUiScreens extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conf_scr_ui_screens', function (Blueprint $table) {
            $table->increments('id');
			$table->string('project', 16);
			$table->integer('screen_id');
			$table->integer('parent_id');
			$table->string('first_screen');
			$table->string('description_text');
			$table->string('url_suffix');
			$table->string('template', 40);
			$table->string('icon_id', 40);
			$table->string('help_text', 60);
			$table->string('video');
			$table->tinyInteger('is_active')->default(1);
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
