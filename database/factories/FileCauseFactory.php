<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FileCause;
use Faker\Generator as Faker;

$factory->define(FileCause::class, function (Faker $faker) {
    return [
        'file_name' => $faker->name.'.jpg',
        'table' => 'Cause',
        'type' => 'image',
        'table_id' => 1,
        'userc_id'=>1,
    ];
});
