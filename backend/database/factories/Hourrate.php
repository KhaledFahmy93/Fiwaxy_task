<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Hourrate;
use App\Models\Service;
use App\Models\Area;
use Faker\Generator as Faker;

$factory->define(Hourrate::class, function (Faker $faker) use($factory) {
    return [
        'service_id' => $factory->create(Service::class)->id,
        'area_id' => $factory->create(Area::class)->id,
        'price' => $faker->randomFloat($nbMaxDecimals = NULL, $min = 1.00, $max = 50.0)
    ];
});
