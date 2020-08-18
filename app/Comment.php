<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Support\Facades\Cache;

class Comment extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id', 'content'];
    public function blogPost(){
        return $this->belongsTo('App\BlogPost');

    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function boot(){
    	parent::boot();
        static::creating(function(Comment $comment){
            Cache::tags(['blog-post'])->forget("blog-post-{$comment->blog_post_id}");
        });
        // static::addGlobalScope(new LatestScope);
    }
}
