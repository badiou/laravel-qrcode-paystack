<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;
use Carbon\Carbon;


$factory->define(App\Models\Account::class, function (Faker $faker) {
    $users = App\Models\User::pluck('id')->all();
    $withdrawal_method=array('Bank','Paypal','Paystack','Tmoney','Flooz');
   
    return [
        'user_id' => $faker->unique()->randomElement($users),
        'balance' => $faker->numberBetween(2,5000),
        'total_credit' => $faker->numberBetween(10,1000),
        'total_debit' => $faker->numberBetween(10,1000),
        'payement_email' => $faker->email,
        'bank_name' => $faker->word,
        'bank_branch' => $faker->state,
        'bank_account' => $faker->bankAccountNumber,
        'applied_for_payout' => $faker->numberBetween(0,1),
        'paid' => $faker->numberBetween(0,1),
        'last_date_applied' => Carbon::now(),
        'last_date_paid' => Carbon::now(),
        'country' => $faker->country,
        'other_details' => $faker->paragraph(4,true),
        'withdrawl_method'=>$withdrawal_method[rand(0,4)]
    ];
});
