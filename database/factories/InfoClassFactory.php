<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\InfoClass;
use Faker\Generator as Faker;

$factory->define(InfoClass::class, function (Faker $faker) {
    return [
        //
        'AccountId' => 64,
        'CourseId' => 10,
        'Active' => 1
    ];
});
