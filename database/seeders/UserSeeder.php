<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Super Admin (Full Control)
        $superAdmin = User::updateOrCreate(
            ['email' => 'superadmin@infomusikcadas.test'],
            [
                'name' => 'Boss Besar Cadas',
                'password' => Hash::make('password'),
            ]
        );
        $superAdmin->forceFill([
            'role' => 'super-admin',
            'is_admin' => true,
        ])->save();

        // Akun Kontributor (Perlu Approval)
        $contributor = User::updateOrCreate(
            ['email' => 'kontributor@infomusikcadas.test'],
            [
                'name' => 'Anak Magang Underground',
                'password' => Hash::make('password'),
            ]
        );
        $contributor->forceFill([
            'role' => 'contributor',
            'is_admin' => false,
        ])->save();
    }
}