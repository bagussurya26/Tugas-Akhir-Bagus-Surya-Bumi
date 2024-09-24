<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::insert([
            [
                'username' => 'adminbumi',
                'password' => Hash::make('password'),
                'real_pass' => 'password',
                'nama' => 'Bumi',
                'email' => 'bumi@gmail.com',
                'no_hp' => '0895123459',
                'role' => 'Pemilik',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'adminulfa',
                'password' => Hash::make('password'),
                'real_pass' => 'password',
                'nama' => 'Ulfa',
                'email' => 'ulfa@gmail.com',
                'no_hp' => '0895123459',
                'role' => 'Staff',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'username' => 'adminmerry',
                'password' => Hash::make('password'),
                'real_pass' => 'password',
                'nama' => 'Merry',
                'email' => 'merry@gmail.com',
                'no_hp' => '0895123459',
                'role' => 'Staff',
                'created_by' => 1,
                'updated_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
