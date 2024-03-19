<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {

    $roles = ['student', 'teacher', 'guardian', 'content_admin', 'finance_admin', 'users_admin'];

    foreach ($roles as $role) {
      Role::insert(['name' => $role]);
    }
  }
}
