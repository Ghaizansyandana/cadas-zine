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
        $superAdmin = User::updateOrCreate(
            ['email' => 'admin@infomusikcadas.com'],
            [
                'name' => 'Gojin Ganteng',
                'password' => Hash::make('Jancok2345'),
            ]
        );
        $superAdmin->forceFill([
            'role' => 'super-admin',
            'is_admin' => true,
        ])->save();

        // 2. Co-Admin / Editor
        $editor = User::updateOrCreate(
            ['email' => 'editor@infomusikcadas.com'],
            [
                'name' => 'Editor Kolektif',
                'password' => Hash::make('editor12345'),
            ]
        );
        $editor->forceFill([
            'role' => 'editor',
            'is_admin' => true,
        ])->save();
    }
}