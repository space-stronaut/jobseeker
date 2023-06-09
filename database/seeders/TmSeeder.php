<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'tm',
            'email' => 'tm@gmail.com',
            'password' => bcrypt(123456),
            'role' => 'tm',
            'alamat' => 'Subang',
            'jenis_kelamin' => 'L'
        ]);
    }
}
