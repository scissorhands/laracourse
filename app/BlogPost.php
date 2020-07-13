<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
// use App\Scopes\LatestScope;
use App\Scopes\DeletedAdminScope;
use Illuminate\Support\Facades\Cache;

class BlogPost extends Model
{
	use SoftDeletes;
    protected $fillable = ['title', 'content', 'user_id'];

    public function comments(){
        return $this->hasMany('App\Comment')->latest();
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
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

    public static function boot(){
        static::addGlobalScope(new DeletedAdminScope);
    	parent::boot();

        static::updating(function(BlogPost $blogPost){
            Cache::forget("blog-post-{$blogPost->id}");
        });


    	static::deleting(function (BlogPost $blogPost){
    		$blogPost->comments()->delete();
    	});
    	static::restoring(function (BlogPost $blogPost) {
            $blogPost->comments()->restore();
        });
    }
}
