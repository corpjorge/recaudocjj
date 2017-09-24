<?php

use Illuminate\Database\Seeder;
use App\Model\Roles;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = new Roles();
      $user->nombre="super admin";
      $user->save();

      $user = new Roles();
      $user->nombre="administrador";
      $user->save();

    }
}
