<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'WeekNumber' => $faker->numberBetween(1, 16),       
        'Content' => $faker->text(50),
    ];
});
