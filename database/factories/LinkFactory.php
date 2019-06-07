<?php

use App\Links\Link;
use Faker\Generator as Faker;

$factory->define(Link::class, function (Faker $faker) {
    return [
        'location' => 'https://www.example.com/',
        'key' => $faker->uuid(),
    ];
});
