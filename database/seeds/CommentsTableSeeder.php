<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$howMany = (int)$this->command->ask("How many Comments do you want to be seeded", 150);
    	$posts = App\BlogPost::all();
    	if(!$posts){
    		$this->command->info("There are no BlogPosts to comment on.");
    	}
        $comments = factory(App\Comment::class, $howMany)->make()->each(function($comment) use ($posts){
    		$comment->blog_post_id = $posts->random()->id;
    		$comment->save();
    	});
    }
}
