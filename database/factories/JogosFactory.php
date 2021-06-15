<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Jogos;
use Faker\Generator as Faker;

$factory->define(Jogos::class, function (Faker $faker) {
    return [
        'titulo' => $faker->text,
        'data' => now(),
        'local' => $faker->address
    ];
});
