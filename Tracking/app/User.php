<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','contact','role','password','verified',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


/**
*
*Returns the shipments created by the user
**/
    public function shipments()
    {
        return $this->hasMany(Shipment::class);
    }

/**
*
*Returns the offices created by the user
**/
    public function offices()
    {
        return $this->hasMany(Office::class);
    }

/**
*
*Returns the office of each employee
**/
    public function employeeoffices()
    {
        return $this->hasOne(Employeeoffice::class);
    }

}


