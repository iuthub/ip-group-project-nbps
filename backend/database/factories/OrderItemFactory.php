<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Item;
use App\Order;
use App\OrderItem;
use Faker\Generator as Faker;

$factory->define(OrderItem::class, function (Faker $faker) {
    return [
        'order_id' => Order::all()->random()->id,
        'item_id' => Item::all()->random()->id,
        'quantity' => $faker->randomDigitNotNull,
        'total' => 0,
    ];
});
