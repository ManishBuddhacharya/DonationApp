<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'table' => 'story',
        'table_id' => 1,
        'comment' => $faker->paragraph,
        'userc_id' => 1
    ];
});
