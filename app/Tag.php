<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tbl_tags';

    public function posts(){
    	return $this->belongsToMany(Post::class,'tbl_post_tag');
    }

}
