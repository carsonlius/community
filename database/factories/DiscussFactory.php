<?php

use Faker\Generator as Faker;

$factory->define(App\Discuss::class, function (Faker $faker) {
    $list_user_ids = \App\User::get(['id'])->toArray();
    $user_id = array_random($list_user_ids)['id'];
    $last_user_id = array_random($list_user_ids)['id'];
    return [
        'title' => $faker->title,
        'user_id' => $user_id,
        'last_user_id' => $last_user_id,
        'body' => $faker->paragraph(),
    ];
});
