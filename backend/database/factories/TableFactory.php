<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Table;
use Faker\Generator as Faker;

$factory->define(Table::class, function (Faker $faker) {
    return [
        'number' => $faker->unique()->numberBetween(1, 25),
        'people_count' => rand(1, 6),
        'min_deposit' => rand(4, 15) * 10000
    ];
});
