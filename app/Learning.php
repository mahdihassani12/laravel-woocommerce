<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Learning extends Model
{
    protected $table = 'tbl_learning';
	
	 public function comments(){
    	return $this->hasMany(Comment::class);
    }
}
