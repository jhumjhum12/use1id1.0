<?php

use Illuminate\Database\Seeder;

class SeedAccessTable extends Seeder
{
    /**
     * Add admin rights for first five users
     *
     * @return void
     */
    public function run()
    {

		DB::table('access_table')->truncate();

		for ($i=1;$i<6;$i++) {
			DB::table('access_table')->insert([
				'id' => $i,
				'level' => 100
			]);
		}
        
    }
}
