<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Event;
use Faker\Generator as Faker;

$factory->define(Event::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'content' => $faker->paragraph,
        'userc_id' => 1,
        'category_id' => 1,
        'address' => $faker->address,
       'dateTime' => now()
    ];
});
