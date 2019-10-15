<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConfScrUiScreenSegments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conf_scr_ui_screen_segments', function (Blueprint $table) {
            $table->increments('id');
			$table->string('project', 16);
			$table->string('segment_id', 16);
			$table->string('screen_id', 16);
			$table->string('segment_title', 60);
			$table->string('model', 100);
			$table->string('class', 255);
			$table->integer('render_type');
			$table->string('identifier', 64);
			$table->string('action', 64);
			$table->string('method', 100);
			$table->integer('sort')->default(1);
			$table->integer('status')->default(1);
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
