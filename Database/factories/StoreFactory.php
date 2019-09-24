<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Modules\Store\Entities\Store;

$factory->define(Store::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'description' => $faker->languageCode,
        'address' => $faker->address
    ];
});
