<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    /**
    *fillable fields
    **/
    protected $fillable = ['name','container_number','max_weight','status','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
