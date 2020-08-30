<?php

namespace App\Http\Controllers;

use App\BlogPost;
use Illuminate\Http\Request;
use App\Http\Requests\StoreComment;
use App\Jobs\NotifyUserPostWasCommented;
use App\Jobs\ThrottledMail;
use App\Mail\CommentPosted;
use App\Mail\CommentPostMarkdown;
use Illuminate\Support\Facades\Mail;

class PostCommentController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->only(['store']);
    }

    public function store(BlogPost $post, StoreComment $request){
        $comment = $post->comments()->create([
            'content'  => $request->input('content'),
            'user_id' => $request->user()->id
        ]);

        // Mail::to($post->user)->send(
        //     new CommentPostMarkdown($comment)
        // );

        // Mail::to($post->user)->queue(
        //     new CommentPostMarkdown($comment)
        // );

        // $when = now()->addMinutes(5);
        // Mail::to($post->user)->later(
        //     $when,
        //     new CommentPostMarkdown($comment)
        // );

        ThrottledMail::dispatch(new CommentPostMarkdown($comment), $post->user);
        NotifyUserPostWasCommented::dispatch($comment);
        // NotifyUserPostWasCommented::dispatch($comment);

        $request->session()->flash('status', 'Comment was created!');
        return redirect()->back();
    }
}
