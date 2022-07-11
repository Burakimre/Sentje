<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function group()
    {
        return $this->belongsToMany(Group::class);
    }

    public function contact()
    {
        return $this->hasMany(Contact::class);
    }

    public function account()
    {
        return $this->hasMany(Account::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function paymentrequest()
    {
        return $this->belongsTo(PaymentRequest::class);
    }

    public function roles()
    {
        return $this->hasOne(Role::class);
    }
}
