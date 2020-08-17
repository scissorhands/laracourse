<?php

use Illuminate\Database\Seeder;

class BlogPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$howMany = (int)$this->command->ask("How many BlogPosts do you want to be seeded", 50);
    	$users = App\User::all();
        $posts = factory(App\BlogPost::class, $howMany)->make()->each(function($post) use ($users){
    		$post->user_id = $users->random()->id;
    		$post->save();
    	});
    }
}
