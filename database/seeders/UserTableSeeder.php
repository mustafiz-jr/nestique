<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Only create admin if not exists
        $adminEmail = 'mustafijjr@gmail.com';
        if (!\App\Models\User::where('email', $adminEmail)->exists()) {
            \App\Models\User::create([
                'name' => 'Admin',
                'email' => $adminEmail,
                'role_id' => 1,
                'password' => bcrypt('password'),
            ]);
        }
    }
}
