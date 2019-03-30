<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['phone','ref_number','shipment_id', 'amount', 'user_id'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($payment) {
            $payment->{$payment->getKeyName()} = (string) Uuid::generate();
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}