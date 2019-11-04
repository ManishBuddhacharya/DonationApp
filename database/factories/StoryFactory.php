<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Story;
use Faker\Generator as Faker;

$factory->define(Story::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'content'=>$faker->paragraph,
        'category_id'=> 1,
        'is_active' => 1,
        'userc_id'=> 1
    ];
});
