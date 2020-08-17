<?php

use App\BlogPost;
use App\Tag;
use Illuminate\Database\Seeder;

class BlogPostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tagCount = Tag::all()->count();
        if(!$tagCount){
            $this->command->info('No tags found. Skipping tags assigning..');
            return;
        }

        $howMannyMin = (int)$this->command->ask('Minimum tags on blog post?', 0);
        $howMannyMax = min((int)$this->command->ask('Maximum tags on blog post?', $tagCount), $tagCount);

        BlogPost::all()->each(function(BlogPost $post) use($howMannyMin, $howMannyMax){
            $take = random_int($howMannyMin, $howMannyMax);
            $tags = Tag::inRandomOrder()->take($take)->get()->pluck('id');
            $post->tags()->sync($tags);
        });
    }
}
