<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SeedLabels::class);
        $this->call(SeedMembers::class);
        $this->call(SeedLanguages::class);
        $this->call(SeedMessages::class);
        $this->call(SeedAccountTypes::class);
		$this->call(SeedAccessTable::class);
		$this->call(SeedScreens::class);
        $this->call(SeedSpokenLanguages::class);
		$this->call(SeedCountries::class);
		$this->call(SeedOAuthClients::class);
		$this->call(SeedCompanies::class);

        echo "\n\r I'm done :) \n\r \n\r";
    }
}
