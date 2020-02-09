<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;



$factory->define(App\Models\AccountHistories::class, function (Faker $faker) {
    $users = App\Models\User::pluck('id')->all();
    $account= App\Models\Account::pluck('id')->all();
    return [
        'account_id' =>$faker->randomElement($account),
        'user_id' =>$faker->randomElement($users),
        'message' => $faker->paragraph(2,true)
    ];
});
