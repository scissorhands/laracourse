<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$howMany = max(
    		(int)$this->command->ask("How many Users do you want to be seeded", 20), 
    		1
    	);
		factory(App\User::class)->states('john-doe')->create();
		factory(App\User::class, $howMany)->create();
    }
}
