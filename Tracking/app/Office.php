<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    //
	/**
	*fillable fields
	**/
    protected $fillable = ['name','city','location','address','contact','contact_person','user_id'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    /**
*
*Returns the office of each employee
**/
    public function employeeoffices()
    {
        return $this->hasMany(Employeeoffice::class);
    }

}
