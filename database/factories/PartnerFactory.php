<?php

/** @var Factory $factory */

use App\Partner;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Partner::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->email,
        'name' => $faker->unique()->company,
    ];
});
