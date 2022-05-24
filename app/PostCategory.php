<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    protected $table = 'tbl_postscategories';

    public function posts(){
    	return $this->belongsToMany(Post::class,' tbl_category_post');
    }

}
