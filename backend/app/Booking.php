<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Elegant
{

    protected $fillable = [
        'table_id',
        'book_date',
        'book_time',
        'people_count',
    ];

    public function rules()
    {
        return [
            'table_id' => 'required|numeric',
            'book_date' => 'required|date',
            'book_time' => 'required|time',
            'people_count' => 'required|numeric'
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
