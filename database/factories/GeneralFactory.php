<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Model\Settings\General::class, function (Faker $faker) {
    return [
        'CompanyName' => $faker->word,
        'websiteLogo' => $faker->text,
        'invoiceLogo' => $faker->text,
        'PrivatePolicy' => $faker->text,
        'AboutUs' => $faker->text,
        'ContcatUs' => $faker->text,
        'TermNCondition' => $faker->text,
    ];
});
