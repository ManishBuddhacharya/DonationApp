<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Files;
use Faker\Generator as Faker;

$factory->define(Files::class, function (Faker $faker) {
    return [
        'file_name' => $faker->name.'.jpg',
        'table' => 'Gallery',
        'type' => 'image',
        'table_id' => 1,
        'userc_id'=>1,
    ];
});
