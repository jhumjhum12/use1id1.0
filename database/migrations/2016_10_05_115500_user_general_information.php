<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserGeneralInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Cards
        Schema::create('bank_accounts_cards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id',16);
            $table->string('card', 255);
        });
        // Bank Accounts / Paypal
 
         Schema::create('bank_accounts_paypal', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id',16);
            $table->string('user_email',64);
        });
         Schema::create('contact_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id',16);
            $table->string('type', 64);
            $table->string('content', 64);
        });

         Schema::table('users', function ($table) {
            $table->string('street', 128)->nullable();
            $table->string('house_number', 16)->nullable();
            $table->string('place', 255)->nullable();
            $table->string('postal_code',16)->nullable();
            $table->string('country', 2)->nullable();
            $table->string('province', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('avatar', 64)->nullable();
             $table->integer('reference_user')->nullable();
             $table->tinyInteger('activated');
         });
         Schema::table('screen', function ($table) {
            $table->tinyInteger('status');

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
        Schema::drop('bank_accounts_cards');
        Schema::drop('bank_accounts_paypal');
        Schema::drop('contact_info');
        Schema::table('users', function ($table) {
            $table->dropColumn('street');
            $table->dropColumn('house_number');
            $table->dropColumn('place');
            $table->dropColumn('province');
            $table->dropColumn('city');
            $table->dropColumn('postal_code');
            $table->dropColumn('country');
        });
        Schema::table('screen', function ($table) {
            $table->dropColumn('status');
        });
    }
}
