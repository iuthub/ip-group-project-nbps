<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderItem extends Model
{
    protected $fillable = [
        'item_id',
        'quantity'
    ];

    public static function boot()
    {
        parent::boot();
        static::saving(function (OrderItem $orderItem) {
            $itemPrice = Item::where('id', $orderItem->item_id)->value('price');
            $orderItem->total = $itemPrice * $orderItem->quantity;
        });
        static::saved(function (OrderItem $orderItem) {
            $order = $orderItem->order;
            $price = OrderItem::where('order_id', $orderItem->order_id)->sum('total');
            $order->total = $price;
            $order->update();
        });
        static::deleted(function (OrderItem $orderItem) {
            $orderItemsCount = OrderItem::where('order_id', $orderItem->order_id)->count();
            if ($orderItemsCount == 0) {
                $order = $orderItem->order;
                $order->delete();
            }
        });
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
