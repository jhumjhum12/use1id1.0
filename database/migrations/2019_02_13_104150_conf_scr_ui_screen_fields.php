<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConfScrUiScreenFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conf_scr_ui_screen_fields', function (Blueprint $table) {
            $table->increments('id');
			$table->string('project', 16);
			$table->string('screenfield_id', 16);
			$table->string('segment_id', 16);
			$table->integer('sort')->default(1);
			$table->string('field_activity', 60);
			$table->string('field', 100);
			$table->string('action', 64);
			$table->string('meta', 255);
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
