<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Download extends Model
{
    protected $table = 'tbl_downloads';
	
	 public function comments(){
    	return $this->hasMany(Comment::class);
    }
}
