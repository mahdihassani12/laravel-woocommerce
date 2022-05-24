<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
     protected $table = 'tbl_posts';

     public function getRouteKeyName(){
        return 'slug';
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function categories(){
    	return $this->belongsToMany(PostCategory::class,'tbl_category_post');
    }

    public function tags(){
    	return $this->belongsToMany(Tag::class,'tbl_post_tag');
    }
	
	  public function comments(){
        return $this->hasMany(Comment::class);
    }

}
