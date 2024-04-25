<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Bishal Roy',
                'username' => 'bishal07',
                'email' => 'bishal@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('1234'),
                'remember_token' => Str::random(10),
                'photo'=> 'bishal.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Md Ashrarul Haque Sifat',
                'username' => 'ashsifat',
                'email' => 'sifatashrarul@gmail.com',
                'email_verified_at' => now(),
                'password' => bcrypt('1234'),
                'remember_token' => Str::random(10),
                'photo'=> 'sifat.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('users')->insert($users);
    }
}
