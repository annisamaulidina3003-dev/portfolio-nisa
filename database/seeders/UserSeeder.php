<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Annisa Maulidina',
            'email' => 'annisa@admin.com',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
        ]);
    }
}
