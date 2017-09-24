<?php

use Illuminate\Database\Seeder;
use App\Model\Estado;

class EstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = new Estado();
      $user->nombre="Completado";
      $user->estilo="success";
      $user->save();

      $user = new Estado();
      $user->nombre="Al día";
      $user->estilo="primary";
      $user->save();

      $user = new Estado();
      $user->nombre="Pendiente";
      $user->estilo="warning";
      $user->save();

      $user = new Estado();
      $user->nombre="Atrasado";
      $user->estilo="danger";
      $user->save();
    }
}
