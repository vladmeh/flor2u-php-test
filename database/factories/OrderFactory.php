<?php

/** @var Factory $factory */

use App\Order;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Carbon;

$factory->define(Order::class, function (Faker $faker) {
    $status = [0, 10, 20];

    return [
        'status' => $status[rand(0, 2)],
        'client_email' => $faker->email,
        'partner_id' => $faker->numberBetween(1, 20),
        'delivery_dt' => Carbon::now(),
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now(),
    ];
});
