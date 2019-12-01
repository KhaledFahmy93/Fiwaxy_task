<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Order;
use App\Models\Service;
use Faker\Generator as Faker;
use App\Models\Orderdetail;

$factory->define(Orderdetail::class, function (Faker $faker) use ($factory) {
    return [
        'service_id' => $factory->create(Service::class)->id,
        'order_id' => $factory->create(Order::class)->id,
        'hours' => $faker->randomDigitNotNull()
    ];
});
