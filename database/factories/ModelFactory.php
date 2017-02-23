<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Activity::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->word,
        'abstract' => $faker->word,
        'schedule' => $faker->text,
        'sign_up_url' => $faker->word,
        'poster_url' => $faker->word,
    ];
});

$factory->define(App\CompetitionMember::class, function (Faker\Generator $faker) {
    return [
        'team_id' => $faker->randomNumber(),
        'is_leader' => $faker->boolean,
        'name' => $faker->name,
        'phone' => $faker->phoneNumber,
        'qq' => $faker->word,
    ];
});

$factory->define(App\CompetitionTeam::class, function (Faker\Generator $faker) {
    return [
        'team_name' => $faker->word,
        'slogen' => $faker->word,
    ];
});

