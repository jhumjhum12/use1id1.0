<?php

use Illuminate\Database\Seeder;

class SeedSpokenLanguages extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 1;

        DB::table('languages_list')->truncate();

            $handle = fopen(app_path()."/../database/seeds/langs1.txt", "r");
                if ($handle) {
                    while (($line = fgets($handle)) !== false) {

                        DB::table('languages_list')->insert(
                        [   
                            "name" => $line
                        ]
                    );
                    }

                    fclose($handle);
                }
            } 


}


