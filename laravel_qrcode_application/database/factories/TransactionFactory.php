<?php

use Faker\Generator as Faker;
$factory->define(App\Models\Transaction::class, function (Faker $faker) {
$status=array('Transaction réussie','initialisation','Echoué');
$method=array('Bank','Paypal','Paystack','Tmoney','Flooz');
$users=App\Models\User::pluck('id')->all();
$qrcode=App\Models\Qrcode::pluck('id')->all();
$number=rand(0,1);
    return [
        'user_id'=>$faker->randomElement($users),
       
        'qrcode_owner_id'=>$faker->randomElement($users),

        'qrcode_id'=>$faker->randomElement($qrcode),

        'payment_method' =>$method.' /card'.$faker->creditCardNumber(),
        'amount' => $faker->numberBetween(100,4000),
        'status' => $status[$number]
        
    ];
});
