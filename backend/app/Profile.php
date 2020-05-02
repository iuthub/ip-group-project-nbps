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
        'city',
        'postcode',
        'address'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
