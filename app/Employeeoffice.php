<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employeeoffice extends Model
{
     /**
	*fillable fields
	**/
    protected $fillable = ['user_id','office_id','office_name','office_city','office_location'];

   public function user()
    {
    	return $this->belongsTo(User::class);
    }

//         /**
// *
// *Returns the office of each employee
// **/
//     public function users()
//     {
//         return $this->hasMany(User::class);
//     }


}