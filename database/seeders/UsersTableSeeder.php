<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Member;


class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
    'name' => 'Admin Librarian',
    'email' => 'admin@library.com',
    'password' => Hash::make('password'),
    'role' => 'admin',
]);

Member::create([
    'name' => 'Admin Librarian',
    'email' => 'admin@library.com',
    'phone' => '123-456-7890',
    'address' => 'Library Office',
    'membership_start' => now(),
]);

        // Regular user (member)
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'role' => 'member',
        ]);
        Member::create([
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'phone' => '555-1234',
    'address' => '123 Main St',
    'membership_start' => now(),
]);
    }
}