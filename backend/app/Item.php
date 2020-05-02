<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Elegant
{

    protected $fillable = [
        'title',
        'description',
        'price',
    ];

    public function rules()
    {
        return [
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public static function getDefaultPhotoURL()
    {
        return 'img/default-item-photo.jpg';
    }
}
