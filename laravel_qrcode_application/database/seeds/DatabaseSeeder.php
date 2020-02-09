<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);
        factory('App\Models\User',10)->create();
        factory('App\Models\Qrcode',50)->create();  
        factory('App\Models\Transaction',100)->create();
        factory('App\Models\Account',100)->create();
        factory('App\Models\AccountHistories',100)->create();




    }
}
