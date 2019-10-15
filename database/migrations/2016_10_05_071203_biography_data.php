<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BiographyData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // Work Experience
        Schema::create('work_experience', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('job_title', 255);
            $table->string('company_name', 255);
            $table->date('start_date');
            $table->date('end_date');
        });

        // Projects
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('work_experience_id');
            $table->string('customer', 255);
            $table->string('project_name', 255);
            $table->string('job_title', 255);
            $table->date('start_date');
            $table->date('end_date');
        });

        // Education
        Schema::create('education', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('course', 255);
            $table->string('institution', 255);
            $table->date('start_date');
            $table->date('end_date');
        });

        // References
        Schema::create('references', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('project_id');
            $table->string('person', 120)->nullable();
            $table->string('job_title', 120)->nullable();
            $table->date('reference_date')->nullable();
            $table->string('position_vs_you', 64)->nullable();
        });

        // Resume Templates
        Schema::create('resume_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('name',255);
            $table->string('path', 128);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('work_experience');
        Schema::drop('projects');
        Schema::drop('education');
        Schema::drop('references');
        Schema::dropIfExists('resume_templates');
    }
}
