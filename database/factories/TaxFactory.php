<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Model\Settings\Tax::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'status' => $faker->boolean,
    ];
});
