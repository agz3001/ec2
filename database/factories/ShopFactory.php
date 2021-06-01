<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Shop;
use Faker\Generator as Faker;

$factory->define(Shop::class, function (Faker $faker) {
    return [
        "name"=>$faker->name,
        "detail"=>$faker->sentence(rand(1,4)),
        "fee"=>$faker->numberBetween($min=100, $max=50000),
        "store_id"=>$faker->numberBetween($min=1, $max=5),
    ];
});
