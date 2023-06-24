<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
   
    public function run()
    {
        DB::table('users')->insert([
            // Admin
            [
                'name' => 'Admin',
                'username' => 'useradmin',
                'email' => 'admin@gmal.com',
                'password' => Hash::make('123'),
                'role' => 'admin',
                'status' => 'active',
            ],

            //vendor
            [
                'name' => 'Vendor',
                'username' => 'uservendor',
                'email' => 'vendor@gmal.com',
                'password' => Hash::make('123'),
                'role' => 'vendor',
                'status' => 'active',
            ],


            // customer
            [
                'name' => 'Customer',
                'username' => 'usercustomer',
                'email' => 'customer@gmal.com',
                'password' => Hash::make('123'),
                'role' => 'user',
                'status' => 'active',
            ],
        ]);
    }
}
