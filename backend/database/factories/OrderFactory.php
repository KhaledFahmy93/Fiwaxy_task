<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use App\Models\Area;
use Faker\Generator as Faker;


$factory->define(Order::class, function (Faker $faker) use ($factory){
    return [
        'description' => $faker->sentence,
        'customer_id' => $factory->create(User::class ,['user_type' => 'customer'])->id,
        'area_id' => $factory->create(Area::class)->id,
        'repairman_ids'=> json_encode([$factory->create(User::class,['user_type' => 'repairman'])->id]),
        'totalprice' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL)
    ];
});
