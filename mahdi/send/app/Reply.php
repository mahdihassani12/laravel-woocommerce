<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $table = 'tbl_replies';

    public function comment(){
    	return $this->belongsTo(Comment::class);
    }
}
