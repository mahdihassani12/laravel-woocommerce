<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'tbl_comments';

    public function post(){
    	return $this->belongsTo(Post::class);
    }

    public function download(){
    	return $this->belongsTo(Download::class);
    }

    public function reply(){
    	return $this->belongsTo(Reply::class);
    }

}
