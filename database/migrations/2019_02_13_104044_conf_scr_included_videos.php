<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConfScrIncludedVideos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conf_scr_included_videos', function (Blueprint $table) {
            $table->increments('id');
			$table->string('project', 16);
			$table->string('video_id');
			$table->string('code2', 2);
			$table->string('file', 40);
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
