<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
     public $table = "settings";
	 public $primaryKey = 'id';
	 public $timestamps = false;
}
