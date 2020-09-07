<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlogPost;
use App\Events\BlogPostPosted;
use App\Facades\CounterFacade;
use App\Http\Requests\StoreBlogPost;
use App\Image;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

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
            'posts'=>BlogPost::latestWithRelations()->get()
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

        $hasFile = $request->hasFile('thumbnail');
        if($hasFile){
            $file = $request->file('thumbnail');
            $pathName = $request->file('thumbnail')->store('thumbnails');
            $post->image()->save(Image::make(['path'=>$pathName]));
        }

        event(new BlogPostPosted($post));

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
        $blogPost = Cache::tags(['blog-post'])->remember("blog-post-{$id}", 60, function() use($id){
            return BlogPost::with(['comments', 'comments.user', 'tags', 'user'])
            ->findOrFail($id);
        });

        return view('posts.show', [
            'post'=>$blogPost,
            'counter' => CounterFacade::increment("blog-post-{$id}", ['blog-post'])
        ]);
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

        $hasFile = $request->hasFile('thumbnail');
        if($hasFile){
            $pathName = $request->file('thumbnail')->store('thumbnails');
            if($post->image){
                Storage::delete($post->image->path);
                $post->image->path = $pathName;
                $post->image->save();
            } else {
                $post->image()->save(Image::make(['path'=>$pathName]));
            }
        }

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
