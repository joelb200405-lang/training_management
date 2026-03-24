<?php

namespace Database\Seeders;

use App\Models\User_tbl;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        user_tbl::create([
            'firstname' => 'Admin',
            'lastname' => 'PhilTrain',
            'email' => 'admin@philtrain.com',
            'username' => 'admin',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);
    }
}
