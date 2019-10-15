<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SyTabFieldLabels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sy_tab_field_labels', function (Blueprint $table) {
            $table->increments('id');
			$table->string('project', 16);
			$table->string('field', 16);
			$table->string('code2', 2);
			$table->string('label', 20);
			$table->string('text', 100);
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
