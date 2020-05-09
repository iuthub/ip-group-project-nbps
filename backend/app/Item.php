<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 0;

    protected $fillable = [
        'category_id',
        'title',
        'description',
        'price',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getStatusAttributeNames()
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_INACTIVE => 'Inactive'
        ];
    }

    public function getStatusAttribute()
    {
        return $this->getStatusAttributeNames()[$this->attributes['status']];
    }

    public static function getDefaultPhotoURL()
    {
        return 'img/default-item-photo.jpg';
    }
}
