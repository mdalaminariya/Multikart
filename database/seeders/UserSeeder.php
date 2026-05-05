<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           User::create([
            'fname' => 'Admin',
            'lname' => 'User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin0088'),
            'role' => 'admin',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'created_at' => now(),
        ]);
    }
}
