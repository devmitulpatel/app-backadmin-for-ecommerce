<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Model\Settings\Website::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'description' => $faker->text,
        'keywords' => $faker->word,
        'logo' => $faker->text,
        'favico' => $faker->text,
    ];
});
