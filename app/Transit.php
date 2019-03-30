<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transit extends Model
{
    //
	/**
	*fillable fields
	**/
    protected $fillable = ['container_number','cons_no','status','from','to','current_location','weight'];
}
