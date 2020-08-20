<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Model\Settings\ActionsTaken::class, function (Faker $faker) {
    return [
        'type' => $faker->randomNumber(),
        'table' => $faker->word,
        'connection' => $faker->word,
        'model' => $faker->word,
        'prefix' => $faker->word,
        'callByFunction' => $faker->word,
        'takenById' => $faker->word,
        'count' => $faker->randomNumber(),
        'whereData' => $faker->text,
        'data' => $faker->text,
    ];
});
