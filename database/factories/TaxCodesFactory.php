<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Model\Settings\TaxCodes::class, function (Faker $faker) {
    return [
        'code' => $faker->randomNumber(),
        'tax' => $faker->text,
        'status' => $faker->boolean,
    ];
});
