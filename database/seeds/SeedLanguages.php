<?php

use Illuminate\Database\Seeder;

class SeedLanguages extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $langs = [
            "EN" => "English",
            "DE" => "German",
            "NL" => "Dutch",
            "FR" => "French"
        ];

        DB::table('languages')->truncate();

        foreach($langs as $key=>$value) {

            $isDefault = ($key=="EN") ? 1 : 0;

            DB::table('languages')->insert(
                [
                    "lang" => $key,
                    "lang_txt" => $value,
                    "lang_default" => $isDefault,
                    
                ]
            );
        }
    }
}


