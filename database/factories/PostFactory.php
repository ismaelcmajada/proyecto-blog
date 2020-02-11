<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\Author;
use App\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    $authors = Author::all()->pluck('id')->toArray();
    $categories = Category::all()->pluck('id')->toArray();
    return [
        'title' => $faker->sentence(10),
        'subtitle' => $faker->sentence(8),
        'content' => $faker->realText(1000),

        'author_id' => $faker->randomElement($authors),
        'category_id' => $faker->randomElement($categories) 
    ];
});
