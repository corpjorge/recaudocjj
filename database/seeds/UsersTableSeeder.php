<?php

use Illuminate\Database\Seeder;
use App\Model\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = new User();
      $user->name = "admin";
      $user->email="corpjorge@hotmail.com";
      $user->password= crypt("111111","");
      $user->rol_id=1;
      $user->save();

      $user = new User();
      $user->name = "Juan Carlos";
      $user->email="instelbo@gmail.com";
      $user->password= crypt("111111","");
      $user->rol_id=2;
      $user->save();

    }
}
