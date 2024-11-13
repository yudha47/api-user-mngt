<?php

namespace Database\Seeders;

use App\Models\listMenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      listMenu::create([
          'name' => 'Dashboard',
          'url' => 'dashboard',
          'default_icon' => 'fas fa-fw fa-tachometer-alt',
          'position_number' => 1
      ]);
      listMenu::create([
          'name' => 'Master Pengguna',
          'url' => 'master-pengguna',
          'default_icon' => 'fas fa-fw fa-user',
          'position_number' => 2
      ]);
      listMenu::create([
          'name' => 'Logout',
          'url' => 'logout',
          'default_icon' => 'fas fa-fw fa-sign-out-alt',
          'position_number' => 3
      ]);
      listMenu::create([
          'name' => 'Pengaturan Tampilan',
          'url' => 'setting',
          'default_icon' => 'fas fa-fw fa-cog',
          'position_number' => 4
      ]);
    }
}
