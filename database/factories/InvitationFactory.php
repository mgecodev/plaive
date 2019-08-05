<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [

        'Accepted' => $faker->optional($weight = 0.9, $default = 1)->numberBetween(0, 0),
    ];
});
