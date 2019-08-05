<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    return [
        'NumOfStudent' => $faker->numberBetween(1, 45),
        'HourCount' => $faker->numberBetween(16, 32),
        'WeekCount' => 16,
        'Prerequisite' => $faker->text(50),
        'Comment' => $faker->text(50),
        'Active' => 1,
    ];
});
