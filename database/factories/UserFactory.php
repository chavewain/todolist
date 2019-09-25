<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Category;
use App\Task;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'verified' => $verificado = $faker->randomElement([User::USER_VERIFIED, User::USER_UNVERIFIED]),
        'verification_token' => $verificado == User::USER_VERIFIED ? '' : User::generateVerificationToken(),
        'admin' => $faker->randomElement([User::USER_ADMIN, User::USER_REGULAR]),
    ];
});

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1),
    ];
});

$factory->define(Task::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->paragraph(1),
        'status' => $faker->randomElement([Task::TASK_AVAILABLE, Task::TASK_UNAVAILABLE]),
        'image' => $faker->randomElement(['https://source.unsplash.com/user/erondu/600x400']),
        'user_id' => User::all()->random()->id,
    ];
});
