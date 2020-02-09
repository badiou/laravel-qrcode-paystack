<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Role::create([
            'name'=>'Admin'
        ]);
        Role::create([
            'name'=>'Moderateur'
        ]);
        Role::create([
            'name'=>'Webmaster'
        ]);
        Role::create([
            'name'=>'Acheteur'
        ]);
    }
}
