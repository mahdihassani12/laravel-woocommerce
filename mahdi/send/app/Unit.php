<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table="tbl_unit";
    protected $fillable =["name","created_by"];
}
