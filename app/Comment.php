<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\Cache;

class Comment extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id', 'content'];


    public function commentable(){
        return $this->morphTo('App\BlogPost');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function boot(){
    	parent::boot();
        static::creating(function(Comment $comment){
            if($comment->commentable_type === App\BlogPost::class){
                Cache::tags(['blog-post'])->forget("blog-post-{$comment->commentable_id}");
                Cache::tags(['blog-post'])->forget('mostCommented');
            }
        });
        // static::addGlobalScope(new LatestScope);
    }
}
