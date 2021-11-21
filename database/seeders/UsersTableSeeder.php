<?php

namespace Database\Seeders;

use \App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminTypes = [
            'super_admin',
            'special_admin',
            'tech_admin',
            'cs_admin',
            'fin_admin',
            'ops_admin',
            'prod_admin',
            'user_admin',
        ];

        foreach($adminTypes as $adminType){
            User::firstOrCreate(
                [
                    'email'     => config('admin.' . $adminType . '_email'), 
                    'username'  => config('admin.' . $adminType . '_username'),
                    'password'  => bcrypt(config('admin.' . $adminType . '_password')),
                ]
            );
        }
    }
}
