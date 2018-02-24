<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    $user_ids = \App\User::orderBy('id', 'desc')->pluck('id')->toArray();
    $user_id = array_random($user_ids);
    $discussion_ids = \App\Discuss::orderBy('id', 'desc')->pluck('id')->toArray();
    $discussion_id = array_random($discussion_ids);

    return [
        'user_id' => $user_id,
        'discussion_id' => $discussion_id,
        'body' => $faker->paragraph
    ];
});
