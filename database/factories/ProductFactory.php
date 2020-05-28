<?php

/** @var Factory $factory */

use App\Product;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => 'Product_' . $faker->randomNumber(),
        'price' => $faker->numberBetween(100, 1000),
        'vendor_id' => $faker->numberBetween(1, 10),
    ];
});
