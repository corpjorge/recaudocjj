<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model
{
  public static function presupuesSuma()
  {
    $dato = Presupuesto::sum('valor_actual');
    return $dato;
  }

  public static function presupuesInicialSuma()
  {
    $dato = Presupuesto::sum('valor_inicial');
    return $dato;
  }

  public static function porcentaje()
  {
    $inicial =  Presupuesto::presupuesInicialSuma();
    $actual =  Presupuesto::presupuesSuma();
    if ($inicial != 0) {
      $porcentaje = ($actual*100)/$inicial;
      return $porcentaje;
    }

  }






}
