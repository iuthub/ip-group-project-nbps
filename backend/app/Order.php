<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Order extends Model
{
    public const STATUS_WAITING = 0;
    public const STATUS_CLOSED = 1;

    protected $fillable = [
        'payment_type',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->total = 0;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasManyThrough(
            Item::class,
            OrderItem::class,
            'order_id',
            'id',
            'id',
            'item_id'
        );
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function waiting(Builder $query)
    {
        return $query->where('status', self::STATUS_WAITING);
    }

    public function closed(Builder $query)
    {
        return $query->where('status', self::STATUS_WAITING);
    }

    protected function getStatusAttributeNames()
    {
        return [
            self::STATUS_CLOSED => 'Closed',
            self::STATUS_WAITING => 'Waiting',
        ];
    }

    public function getStatusAttribute()
    {
        return $this->getStatusAttributeNames()[$this->attributes['status']];
    }
}
