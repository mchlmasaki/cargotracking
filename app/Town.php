<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    //
	/**
	*fillable fields
	**/
    protected $fillable = ['town','county','points'];
}
