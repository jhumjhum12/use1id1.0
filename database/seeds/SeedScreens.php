<?php

use Illuminate\Database\Seeder;

class SeedScreens extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('screen')->truncate();
        DB::table('screen_segments')->truncate();
        DB::table('screen_fields')->truncate();

        DB::unprepared(file_get_contents(app_path()."/../database/seeds/screen.sql"));
        DB::unprepared(file_get_contents(app_path()."/../database/seeds/screen_fields.sql"));
        DB::unprepared(file_get_contents(app_path()."/../database/seeds/screen_segments.sql"));


    }
}
