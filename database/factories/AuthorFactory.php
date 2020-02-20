<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Author;
use App\User;
use App\Role;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Author::class, function (Faker $faker) {
    $user = factory(User::class)->create();
    $user->roles()->attach(Role::find(2));
    $user->roles()->attach(Role::find(3));
    $user->save();
    return [
        'name' => $user->name,
        'birth_date' => now(),
        'description' => $faker->realText(),

        'user_id' => $user->id
    ];
});
