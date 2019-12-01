<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Area;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Area::class, function (Faker $faker) use ($factory) {
    return [
        'name' => $faker->state,
        'repairman_id' => $factory->create(User::class,['user_type' => 'repairman'])->id
    ];
});
