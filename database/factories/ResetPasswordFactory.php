<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\PasswordReset;

$factory->define(PasswordReset::class, function (Faker $faker) {

    $user = factory(\App\User::class)->create();

    return [
        'email' => $user->email,
        'token' => Str::random(60)
    ];
});
