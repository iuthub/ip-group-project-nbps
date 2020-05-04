<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'payment_type',
    ];


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
}
