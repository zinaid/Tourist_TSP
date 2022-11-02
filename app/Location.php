<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public $table = "map";
	 public $primaryKey = 'id';
	 public $timestamps = false;
}
