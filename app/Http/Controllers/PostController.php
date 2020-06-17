<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlogPost;
use App\User;
use App\Http\Requests\StoreBlogPost;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only([
            'create', 'store', 'edit', 'update', 'destroy'
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index', [
            'posts'=>BlogPost::latest()->withCount('comments')->get(),
            'most_commented' => BlogPost::mostCommented()->take(5)->get(),
            'most_active_users' => User::withMostBlogPosts()->take(5)->get(),
            'most_active_last_month' => User::withMostBlogPostsLastMonth()->take(5)->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBlogPost $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = $request->user()->id;;
        $post = BlogPost::create($validated);
        $request->session()->flash('status', 'Blog Post created');
        return redirect()->route('posts.show', ['post'=>$post->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('posts.show', ['post'=>BlogPost::with('comments')->findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);
        $this->authorize('update', $post);
        return view('posts.edit', ['post'=>$post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreBlogPost $request, $id)
    {
        $post = BlogPost::findOrFail($id);
        $this->authorize('update', $post);

        $validated = $request->validated();
        $post->fill($validated);
        $post->save();
        $request->session()->flash('status', 'Blog Post was updated');
        return redirect()->route('posts.show', ['post'=>$post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);
        $this->authorize('delete', $post);
        $post->delete();
        $request->session()->flash('status', 'Blog Post was deleted');
        return redirect()->route('posts.index');
    }
}
