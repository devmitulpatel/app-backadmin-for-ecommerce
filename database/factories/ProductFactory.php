<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Model\Product\Product::class, function (Faker $faker) {
    return [
        'barcode' => $faker->word,
        'name' => $faker->name,
        'sname' => $faker->word,
        'version' => $faker->word,
        'pimg' => $faker->text,
        'pimgs' => $faker->text,
        'description' => $faker->text,
        'cat' => $faker->randomNumber(),
        'scat' => $faker->randomNumber(),
        'unit' => $faker->randomNumber(),
        'urate' => $faker->randomNumber(),
        'keepStock' => $faker->boolean,
        'ostock' => $faker->randomNumber(),
        'feature' => $faker->boolean,
        'new' => $faker->boolean,
        'extraFields' => $faker->text,
        'status' => $faker->boolean,
    ];
});
