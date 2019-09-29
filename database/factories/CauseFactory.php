<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cause;
use Faker\Generator as Faker;

$factory->define(Cause::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'content'=>$faker->paragraph,
        'goal'=> $faker->randomDigit,
        'category_id'=> 1,
        'userc_id'=> 1
    ];
});
