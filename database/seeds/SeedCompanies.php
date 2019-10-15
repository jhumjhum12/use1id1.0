<?php

use Illuminate\Database\Seeder;

class SeedCompanies extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();

        for($i=1; $i<=10; $i++)
        {

            DB::table('companies')->insert(
                [
                    // 'title'=>$title,
                    'user_id'=>$i,
                    'name' => $faker->company,
                    'registration_number'=>rand( 111111111111, 999999999999),
                    'website'=>$faker->url
                ]
            );


        }

    }
}
