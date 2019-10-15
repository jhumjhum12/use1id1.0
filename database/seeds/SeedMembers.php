<?php

use Illuminate\Database\Seeder;

class SeedMembers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();

        $count = DB::table('users')->count();
        $freshSeed = ($count==0) ? true : false;



        for($i=1; $i<=10; $i++)
        {
            $email = $faker->email;
            $rand = rand(0,1);
            $title = "Mr";
            $first_name = $faker->firstNameMale;
            if($rand==0) {
            }
            if($rand==1) {
                $title = "Mrs";
                $first_name = $faker->firstNameFemale;
            }

            if($freshSeed) {
                $email = "user" . $i . "@1id.com";
            } else {
                $email = $faker->email;
            }

            DB::table('users')->insert(
                [
                    // 'title'=>$title,
                    'email'=>$email,
                    'password' => Hash::make('password'),
                    'personal_email'=>$email,
                    'personal_id'=>rand( 111111111111, 999999999999),
                    'first_name'=>$first_name,
                    'middle_name'=>"",
                    'last_name'=>$faker->lastName,
                    'nickname'=>'',
                    //'birthday'=>$faker->dateTimeBetween('-60 years', '-18 years'),
                    //'avatar'
                    'birthday'=>'1990-11-20',
                    'country_of_birth'=>"BE",
                    'city_of_birth'=>1,
                    'blood_type'=>rand(1,10),
                    'selected_lang'=>1,
                    'activated'=>1
                ]
            );

            $user_id = DB::getPdo()->lastInsertId();

            // add some experience
            for($j=0; $j<=rand(1,5); $j++) {
                DB::table('work_experience')->insert(
                    [
                        'user_id'=>$user_id,
                        'job_title'=>$faker->jobTitle,
                        'company_name'=>$faker->company,
                        'start_date'=>$faker->dateTimeBetween('-10 years', 'now'),
                        'end_date'=>$faker->dateTimeBetween('-10 years', 'now')
                    ]
                );
            }

            // add some projects
            /*
            for($j=0; $j<=rand(1,5); $j++) {
                DB::table('projects')->insert(
                    [
                        'user_id'=>$user_id,
                        'company_name'=>$faker->company,
                        'customer'=>$faker->company,
                        'project_name'=>$faker->safeColorName,
                        'job_title'=>$faker->jobTitle,
                        'start_date'=>$faker->dateTimeBetween('-10 years', 'now'),
                        'end_date'=>$faker->dateTimeBetween('-10 years', 'now')
                    ]
                );
            }
            */

            // add some bookmarks
            for($j=0; $j<=rand(1,50); $j++) {
                DB::table('bookmarks')->insert(
                    [
                        'user_id'=>$user_id,
                        'title'=>$faker->text(64),
                        'url'=>$faker->url,
                        'starred'=>rand(0,1),
                    ]
                );
            }

            // add some tags
            for($j=0; $j<=rand(1,10); $j++) {
                DB::table('tags')->insert(
                    [
                        'user_id'=>$user_id,
                        'name'=>$faker->text(8)
                    ]
                );
            }


            // add some education
            for($j=0; $j<=rand(1,5); $j++) {
                DB::table('education')->insert(
                    [
                        'user_id'=>$user_id,
                        'course'=>$faker->text(64),
                        'institution'=>$faker->company . " School",
                        'start_date'=>$faker->dateTimeBetween('-10 years', 'now'),
                        'end_date'=>$faker->dateTimeBetween('-10 years', 'now')
                    ]
                );
            }

            // add contact info
            for($j=0; $j<=rand(0,3); $j++) {
                DB::table('contact_info')->insert(
                    [
                        'user_id'=>$user_id,
                        'type'=>rand(1,5),
                        'content'=>$faker->phoneNumber
                    ]
                );
            }

            // add spoken languages
            for($j=0; $j<=rand(1,5); $j++) {

                DB::table('spoken_languages')->insert(
                    [
                        'user_id'=>$user_id,
                        'languages_list_id'=>rand(1,90),
                        'listening'=>rand(1,10),
                        'speaking'=>rand(1,10),
                        'reading'=>rand(1,10),
                        'writing'=>rand(1,10)
                    ]
                );
            }

            // add bank account cards
            for($j=0; $j<=rand(0,5); $j++) {
                DB::table('bank_accounts_cards')->insert(
                    [
                        'user_id'=>$user_id,
                        'card'=>$faker->creditCardNumber
                    ]
                );
            }

            // add paypal accounts
            for($j=0; $j<=rand(0,2); $j++) {
                DB::table('bank_accounts_paypal')->insert(
                    [
                        'user_id'=>$user_id,
                        'user_email'=>$faker->email
                    ]
                );
            }

            echo $email . " added \n";

        }

    }
}
