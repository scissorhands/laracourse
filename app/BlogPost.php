<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\DeletedAdminScope;
use App\Traits\Taggable;
use Illuminate\Support\Facades\Cache;

class BlogPost extends Model
{
	use SoftDeletes, Taggable;
    protected $fillable = ['title', 'content', 'user_id'];

    public function comments(){
        return $this->morphMany('App\Comment', 'commentable')->latest();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function image(){
        return $this->morphOne('App\Image', 'imageable');
    }

    public function scopeLatest(Builder $queryBuilder)
    {
        $queryBuilder->orderBy(static::CREATED_AT, 'desc');
    }

    public function scopeMostCommented(Builder $query)
    {
        return $query->withCount('comments')
        ->orderBy('comments_count', 'desc');
    }

    public function scopeLatestWithRelations(Builder $query){
        return $query->latest()
        ->withCount('comments')
        ->with(['user', 'tags']);
    }

    public static function boot(){
        static::addGlobalScope(new DeletedAdminScope);
    	parent::boot();

        static::updating(function(BlogPost $blogPost){
            Cache::tags(['blog-post'])->forget("blog-post-{$blogPost->id}");
        });


    	static::deleting(function (BlogPost $blogPost){
            $blogPost->comments()->delete();
            Cache::tags(['blog-post'])->forget("blog-post-{$blogPost->id}");
    	});
    	static::restoring(function (BlogPost $blogPost) {
            $blogPost->comments()->restore();
        });
    }
}
