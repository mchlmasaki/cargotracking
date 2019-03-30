<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shippingrate extends Model
{
    /**
	*fillable fields
	**/
    protected $fillable = ['weight_from','weight_to','rate'];
}
