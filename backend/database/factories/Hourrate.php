<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Hourrate;
use App\Models\Service;
use App\Models\Area;
use Faker\Generator as Faker;

$factory->define(Hourrate::class, function (Faker $faker) use($factory) {
    return [
        'service_id' => $faker->unique()->numberBetween($min = 1, $max = 50),
        'area_id' => $faker->unique()->numberBetween($min = 1, $max = 50),
        'price' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 1.00, $max = 50.0)
    ];
});
