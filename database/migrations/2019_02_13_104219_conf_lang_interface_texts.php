<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConfLangInterfaceTexts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('conf_lang_interface_texts', function (Blueprint $table) {
            $table->increments('id');
			$table->string('project', 16);
			$table->string('text_id', 60);
			$table->string('code2', 2);			
			$table->string('long_text', 100);			
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
