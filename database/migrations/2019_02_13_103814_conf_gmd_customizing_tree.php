<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConfGmdCustomizingTree extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conf_gmd_customizing_tree', function (Blueprint $table) {
            $table->increments('id');
			$table->string('project', 16);
			$table->string('config_group', 20);
			$table->string('description', 60);			
			$table->integer('order');
			$table->string('upper', 20);
			$table->string('auth', 40);			
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
