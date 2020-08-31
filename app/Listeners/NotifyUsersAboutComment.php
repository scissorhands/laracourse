<?php

namespace App\Listeners;

use App\Events\CommentPosted;
use App\Jobs\NotifyUserPostWasCommented;
use App\Jobs\ThrottledMail;
use App\Mail\CommentPostMarkdown;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyUsersAboutComment
{

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CommentPosted $event)
    {
        $user = $event->comment->commentable->user;
        ThrottledMail::dispatch(new CommentPostMarkdown($event->comment), $user)
        ->onQueue('high');
        NotifyUserPostWasCommented::dispatch($event->comment)
        ->onQueue('low');
    }
}
