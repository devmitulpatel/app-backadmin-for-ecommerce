<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Model\Product\ProductImages::class, function (Faker $faker) {
    return [
        'code' => $faker->word,
        'path' => $faker->text,
    ];
});
