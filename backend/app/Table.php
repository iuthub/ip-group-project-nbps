<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Elegant
{
    protected $guarded = [];

    public function rules()
    {
        return [
            'number' => 'required|numeric|unique:tables',
            'people_count' => 'required|integer',
            'min_deposit' => 'required|double',
        ];
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
