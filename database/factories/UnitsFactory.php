<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Model\Settings\Product\Units::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'shortname' => $faker->word,
        'unit' => $faker->randomNumber(),
        'uunitId' => $faker->randomNumber(),
        'uunit' => $faker->randomFloat(),
        'dunitId' => $faker->randomNumber(),
        'dunit' => $faker->randomFloat(),
        'status' => $faker->boolean,
    ];
});
