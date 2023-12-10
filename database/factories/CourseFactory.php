<?php

use App\Course;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Course::class, function (Faker $faker) {
    return [
        'title' => "Course" . $faker->randomNumber(2),
        'description' => $faker->text,
        'price' => $faker->numberBetween(100, 1000),
        'image' => $faker->imageUrl(640, 480, 'cats'),
        'no_of_hours' => $faker->numberBetween(1, 100),
        'no_of_lectures' => $faker->numberBetween(1, 100),
    ];
});
