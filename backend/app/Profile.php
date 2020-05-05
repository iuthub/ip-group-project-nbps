<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'firstname',
        'lastname',
        'birthday',
        'phone',
        'country',
        'postcode',
        'address'
    ];

    protected $appends = [
        'fullname'
    ];

    protected $hidden = [
        'user_id',
        'firstname',
        'lastname'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullnameAttribute()
    {
        return "{$this->firstname} {$this->lastname}";
    }
}
