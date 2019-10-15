<?php

use Illuminate\Database\Seeder;

class SeedAccountTypes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            "UID" => "User ID",
            "CID" => "Company ID"
        ];

        DB::table('account_types')->truncate();

        foreach($types as $key => $value) {

            DB::table('account_types')->insert(
                [
                    "lang" => "EN",
                    "acc_type" => $key,
                    "acc_type_descr" => $value
                ]
            );
        }
    }
}
