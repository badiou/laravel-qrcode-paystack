<?php

use Faker\Generator as Faker;



$factory->define(App\Models\Qrcode::class, function ($faker) {
    $users = App\Models\User::pluck('id')->all();
    $number=rand(0,1);
    return [
        'product_name'=>$faker->word,
        'company_name'=>$faker->name,
        'website'=>$faker->url,
        'callback_url' => $faker->url,
        'qrcode_path' => 'les_qrcodes/4.png',
        'amount' => $faker->numberBetween(10,1000),
        'status' => $number,
        //ici vu que c'est une clé étrangère, on doit récupérer l'utilsateur qui existe deja dans la table user
         'user_id' => $faker->randomElement($users)
    ];
});
