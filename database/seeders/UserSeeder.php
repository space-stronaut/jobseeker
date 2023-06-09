<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::create([
        //     'name' => 'admin',
        //     'email' => 'admin@gmail.com',
        //     'password' => bcrypt(123456),
        //     'role' => 'admin',
        //     'alamat' => 'Subang',
        //     'jenis_kelamin' => 'L'
        // ]);

        User::create([
            'name' => 'pelamar',
            'email' => 'pelamar@gmail.com',
            'password' => bcrypt(123456),
            'role' => 'pelamar',
            'alamat' => 'Subang',
            'jenis_kelamin' => 'L'
        ]);
    }
}
