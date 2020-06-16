<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Scopes\LatestScope;

class Comment extends Model
{
	use SoftDeletes;
    public function blogPost(){
        return $this->belongsTo('App\BlogPost');
    }

    public static function boot(){
    	parent::boot();

        static::addGlobalScope(new LatestScope);
    }
}
