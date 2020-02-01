<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Domain\Floor;
use Faker\Generator as Faker;

$factory->define(Floor::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
    ];
});
