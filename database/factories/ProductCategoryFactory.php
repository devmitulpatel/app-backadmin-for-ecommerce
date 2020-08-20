<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Model\Product\ProductCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'cimg' => $faker->word,
        'description' => $faker->text,
        'ParentCategoryId' => $faker->word,
        'status' => $faker->boolean,
    ];
});
