<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Super Admin (Ghoizan)
        User::updateOrCreate(
            ['email' => 'admin@infomusikcadas.com'],
            [
                'name' => 'Gojin Ganteng',
                'password' => Hash::make('Jancok2345'), // ganti password-nya
                'is_admin' => true,
            ]
        );

        // 2. Co-Admin / Editor
        User::updateOrCreate(
            ['email' => 'editor@infomusikcadas.com'],
            [
                'name' => 'Editor Kolektif',
                'password' => Hash::make('editor12345'),
                'is_admin' => true,
            ]
        );
    }
}