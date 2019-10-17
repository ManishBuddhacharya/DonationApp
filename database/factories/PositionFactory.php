<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Position;
use Faker\Generator as Faker;

$factory->define(Position::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'userc_id'=>1
    ];
});
