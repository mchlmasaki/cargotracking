<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    /**
	*fillable fields
	**/
    protected $fillable = ['keywords','town','county','points'];
}
