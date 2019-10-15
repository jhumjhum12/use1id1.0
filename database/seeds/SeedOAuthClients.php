<?php

use Illuminate\Database\Seeder;

class SeedOAuthClients extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = [
			[
				'name' => 'Chrome Extension', 
				'secret' => 'tq9kIzU1o0LBmD0Of8wbrwiYBtPfVHYSUWys5UCZ', 
				'redirect' => 'http://localhost', 
				'personal_access_client' => 0, 
				'password_client' => 1, 
				'revoked' => 0
			],
			[
				'name' => 'Password Manager', 
				'secret' => '22rbzx42yij2pGmF46lJmbVBygxXC33kFXLYJWRh', 
				'redirect' => 'http://localhost', 
				'personal_access_client' => 0, 
				'password_client' => 1, 
				'revoked' => 0
			]
        ];

        DB::table('oauth_clients')->truncate();

        foreach($clients as $c) {
			DB::table('oauth_clients')->insert($c);
        }
    }
}
