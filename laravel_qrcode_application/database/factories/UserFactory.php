<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Role;
use Faker\Generator as Faker;

$factory->define(App\Models\User::class, function (Faker $faker) {

    return [
        'name' => $faker->name,
        'role_id' =>$faker->numberBetween(1,4),
        'email' => $faker->unique()->safeEmail,
        //ici la méthode Hash permet de Hasher le mot de passe pour qu'il soit crypté dans la base de données
        'password' => Hash::make('B@diou2015'),
        'remember_token' => str_random(10),
      
    ];
});
