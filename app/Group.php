<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'owner_id',
        'groupname'
    ];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}
