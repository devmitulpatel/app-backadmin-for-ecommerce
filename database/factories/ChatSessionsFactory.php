<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Model\Chat\ChatSessions::class, function (Faker $faker) {
    return [
        'country' => $faker->country,
        'countryCode' => $faker->word,
        'region' => $faker->word,
        'city' => $faker->city,
        'zip' => $faker->postcode,
        'lat' => $faker->latitude,
        'lon' => $faker->word,
        'timezone' => $faker->word,
        'isp' => $faker->word,
        'org' => $faker->word,
        'ip' => $faker->word,
    ];
});
