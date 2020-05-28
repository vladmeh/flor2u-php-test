<?php

/** @var Factory $factory */

use App\Vendor;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Vendor::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->email,
        'name' => $faker->unique()->company,
    ];
});
