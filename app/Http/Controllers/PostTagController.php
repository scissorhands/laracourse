<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class PostTagController extends Controller
{
    public function index($tag){
        $tag=Tag::findOrFail($tag);
        return view('posts.index', [
            'posts'=> $tag->blogPosts,
            'most_commented' => [],
            'most_active_users' => [],
            'most_active_last_month' => []
        ]);
    }
}
