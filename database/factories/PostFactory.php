<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
  $count=User::count();
    return [
        "title" => $faker->name,
        "content"=>$faker->text($maxNbChars=50),
        "user_id"=> $faker->numberBetween(1, $count)
    ];
});
