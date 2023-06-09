<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'hr',
            'email' => 'hr@gmail.com',
            'password' => bcrypt(123456),
            'role' => 'hr',
            'alamat' => 'Subang',
            'jenis_kelamin' => 'L'
        ]);
    }
}
