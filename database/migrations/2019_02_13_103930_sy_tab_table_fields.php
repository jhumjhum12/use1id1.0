<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SyTabTableFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sy_tab_table_fields', function (Blueprint $table) {
            $table->increments('id');
			$table->string('project', 16);
			$table->string('table', 40);
			$table->string('field', 16);			
			$table->integer('order');
			$table->boolean('key');
			$table->string('check_table', 40);			
			$table->string('check_field', 16);
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
