<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Service;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Service::class, function (Faker $faker) use ($factory){
    return [
        'name' => $faker->name,
        'repairman_id' => $factory->create(User::class,['user_type' => 'repairman'])->id
    ];

});
