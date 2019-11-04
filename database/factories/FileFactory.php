<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Files;
use Faker\Generator as Faker;

$factory->define(Files::class, function (Faker $faker) {
    return [
        'file_name' => $faker->name.'.jpg',
        
        'type' => 'image',
        'table_id' => 1,
        'userc_id'=>1,
    ];
});

$factory->state(Files::class, 'gallery', function (Faker $faker) {
    return [
    	'table' => 'Gallery',
    ];
});

$factory->state(Files::class, 'story' , function (Faker $faker) {
    return [
    	'table' => 'Story',
    ];
});

$factory->state(Files::class, 'event' , function (Faker $faker) {
    return [
        'table' => 'Event',
    ];
});

