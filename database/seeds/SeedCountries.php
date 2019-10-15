<?php

use Illuminate\Database\Seeder;

class SeedCountries extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('countries')->truncate();
        DB::unprepared(file_get_contents(app_path()."/../database/seeds/countries.sql"));
    }
}
