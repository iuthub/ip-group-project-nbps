<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        'category_id' => Category::all()->random()->id,
        'title' => $faker->word,
        'description' => $faker->text,
        'price' => rand(2, 14) * 1000,
        'image' => Item::getDefaultPhotoURL()
    ];
});
