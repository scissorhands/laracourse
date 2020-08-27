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
        $posts = App\BlogPost::all();
        $users = App\User::all();

    	if(!$posts || !$users){
    		$this->command->info("There are no BlogPosts to comment on.");
        }

        $howMany = (int)$this->command->ask("How many Comments do you want to be seeded", 150);

        factory(App\Comment::class, $howMany)->make()->each(function($comment) use ($posts, $users){
            $comment->commentable_id = $posts->random()->id;
            $comment->commentable_type = 'App\BlogPost';
            $comment->user_id = $users->random()->id;
    		$comment->save();
        });

        factory(App\Comment::class, $howMany)->make()->each(function($comment) use ($users){
            $comment->commentable_id = $users->random()->id;
            $comment->commentable_type = 'App\User';
            $comment->user_id = $users->random()->id;
    		$comment->save();
    	});
    }
}
