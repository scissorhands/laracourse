<?php

namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;
use App\BlogPost;
use App\User;

class ActivityComposer
{
    public function compose(View $view){
        $mostCommented = Cache::tags(['blog-post'])->remember('most-commented', now()->addMinutes(60), function() {
            return BlogPost::mostCommented()->take(5)->get();
        });
        $mostActiveUsers = Cache::tags(['blog-post'])->remember('most-active-users', now()->addMinutes(60), function() {
            return User::withMostBlogPosts()->take(5)->get();
        });
        $mostActiveLastMonth = Cache::tags(['blog-post'])->remember('most-active-last-month', now()->addMinutes(60), function() {
            return User::withMostBlogPostsLastMonth()->take(5)->get();
        });
        $view->with('mostCommented', $mostCommented);
        $view->with('mostActiveUsers', $mostActiveUsers);
        $view->with('mostActiveLastMonth', $mostActiveLastMonth);
    }
}
