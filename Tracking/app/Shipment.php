<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    /**
     *fillable fields
     * 
     **/
    protected $fillable = ['sender_name','sender_contact','sender_email','from_location','nearest_town','from_lat','from_lng','sender_address','receiver_name','receiver_contact','to_location','to_lat','to_lng','receiver_address','type_ofshipment','product_name','qty','weight','shipping_rate','shipping_cost','description','mode','cons_no','status','user_id'];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
