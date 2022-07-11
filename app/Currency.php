<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'currency'
    ];

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function payment_request()
    {
        return $this->hasMany(PaymentRequest::class);
    }
}
