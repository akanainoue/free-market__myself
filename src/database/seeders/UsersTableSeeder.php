<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userA = User::create(
            [
                'name' => 'ユーザーA', 
                'email' => 'usera@example.com',
                'password' => Hash::make('password')
            ]
        );

        $userB = User::create(
            [
                'name' => 'ユーザーB', 
                'email' => 'userb@example.com',
                'password' => Hash::make('password')
            ]
        );

        $userC = User::create(
            [
                'name' => 'ユーザーC', 
                'email' => 'userc@example.com',
                'password' => Hash::make('password')
            ]
        );
    }
}
