<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Elegant
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

    public function rules()
    {
        return [
            'fistname' => 'alpha',
            'lastname' => 'alpha',
            'birthday' => 'date',
            'phone' => 'regex:(?:\+\([9]{2}[8]\)[0-9]{2}\ [0-9]{3}\-[0-9]{2}\-[0-9]{2})',
            'country' => 'alpha',
            'postcode' => 'numeric',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
