<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersTableInit extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            // General Data
            $table->dropColumn('name');

            $table->string('personal_email', 62);
            $table->string('personal_id',32);
            $table->string('first_name', 50);
            $table->string('middle_name', 50)->nullable();
            $table->string('last_name', 50);
            $table->string('nickname', 50)->nullable();
            $table->date('birthday')->nullable();
            $table->string('country_of_birth',2)->nullable();
            $table->string('city_of_birth', 50)->nullable();
            $table->smallInteger('blood_type')->nullable();
            $table->smallInteger('selected_lang');
            $table->integer('activation_code')->nullable();

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function ($table) {

            $table->dropColumn('personal_email');
            $table->dropColumn('personal_id');
            $table->dropColumn('first_name');
            $table->dropColumn('middle_name');
            $table->dropColumn('last_name');
            $table->dropColumn('nickname');
            $table->dropColumn('birthday');
            $table->dropColumn('country_of_birth');
            $table->dropColumn('city_of_birth');
            $table->dropColumn('blood_type');
            $table->dropColumn('myID_logon_lang');
            $table->string('name');
        });
    }
}
