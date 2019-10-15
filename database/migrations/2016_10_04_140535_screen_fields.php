<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ScreenFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //

        Schema::create('screen', function (Blueprint $table) {
            $table->string('id', 16);
            $table->string('parent', 16)->nullable();
            $table->string('name', 255);
            $table->string('label', 255)->nullable();
            $table->string('slug', 255);
            $table->string('template', 255);
            $table->string('class')->nullable();
            $table->string('identifier', 64)->nullable();
            $table->integer('sort')->default(1);
            $table->timestamps();
            $table->primary('id');
        });

        Schema::create('screen_fields', function (Blueprint $table) {
            $table->string('id', 16);
            $table->string('screen_segment_id', 16);
            $table->string('type', 64);
            $table->string('name', 255)->nullable();
            $table->string('label', 255)->nullable();
            $table->string('action', 64)->nullable();
            $table->text('meta')->nullable();
            $table->integer('sort')->default(1);
            $table->timestamps();
            $table->primary('id');
        });
        Schema::create('screen_segments', function (Blueprint $table) {
            $table->string('id', 16);
            $table->string('screen_id');
            $table->string('name', 255)->nullable();
            $table->string('model', 255)->nullable();
            $table->string('class', 255)->nullable();
            $table->integer('render_type')->default(1);
            $table->string('identifier', 64)->nullable();
            $table->string('action', 64)->nullable();
            $table->string('method', 16)->nullable();
            $table->integer('sort')->default(1);
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->primary('id');
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
        Schema::drop('screen');
        Schema::drop('screen_fields');
        Schema::drop('screen_segments');
    }
}
