<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\FileNews;
use Faker\Generator as Faker;

$factory->define(FileNews::class, function (Faker $faker) {
    return [
        'file_name' => $faker->name.'.jpg',
        'table' => 'News',
        'type' => 'image',
        'table_id' => 1,
        'userc_id'=>1,
    ];
});
