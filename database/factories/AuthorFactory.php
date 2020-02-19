<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Author;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Author::class, function (Faker $faker) {
    $user = factory(App\User::class)->create();
    return [
        'name' => $user->name,
        'birth_date' => now(),
        'description' => $faker->realText(),

        'user_id' => $user->id
    ];
});
