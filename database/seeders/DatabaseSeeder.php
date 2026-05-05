<?php

namespace Database\Seeders;

use App\Models\User;
use DB;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

          DB::table('users')->insert([
            'fname' => 'Admin',
            'lname' => 'Alamin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin0088'),
            'role' => 'admin',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'created_at' => now(),
        ]);
    }
}
