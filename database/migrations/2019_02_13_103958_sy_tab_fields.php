<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SyTabFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sy_tab_fields', function (Blueprint $table) {
            $table->increments('id');
			$table->string('project', 16);
			$table->string('field', 16);
			$table->string('fieldtype', 16);
			$table->integer('length');
			$table->string('default', 40);
			$table->string('collation', 40);
			$table->string('attribute', 40);
			$table->boolean('null');
			$table->boolean('autoincrement');
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
