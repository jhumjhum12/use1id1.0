<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SyTabTableDefinitions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('sy_tab_table_definitions', function (Blueprint $table) {
            $table->increments('id');
			$table->string('project', 16);
			$table->string('table', 40);
			$table->text('description');
			$table->string('config_group', 20);
			$table->integer('order');
			$table->boolean('insert_allowed');
			$table->string('text_id', 60);
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
