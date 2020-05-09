<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 0;

    protected $fillable = [
        'title',
        'description'
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
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
}
