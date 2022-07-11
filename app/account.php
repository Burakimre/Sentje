<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'iban'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function paymentrequest()
    {
        return $this->hasMany(PaymentRequest::class);
    }
}
