<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = [
        'number',
        'people_count',
        'min_deposit'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
