<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model\Friendship::class, function (Faker $faker) {


    $loggedUser = \App\User::inRandomOrder()->first();
    $toFollower = \App\User::inRandomOrder()->first();

    return [
        'user_id' => $loggedUser->id,
        'follower_id' => $toFollower->id,
    ];
});
