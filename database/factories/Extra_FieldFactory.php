<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Model\Settings\Product\Extra_Field::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'dname' => $faker->word,
        'cat' => $faker->word,
        'scat' => $faker->word,
        'type' => $faker->word,
        'dvalue' => $faker->word,
        'required' => $faker->boolean,
        'status' => $faker->boolean,
    ];
});
