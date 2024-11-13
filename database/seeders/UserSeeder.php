<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      User::create([
          'user_fullname' => 'Super Admin',
          'user_email' => 'sa@gmail.com',
          'user_password' => bcrypt('P@ssw0rd')
      ]);
    }
}
