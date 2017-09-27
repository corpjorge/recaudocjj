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

  public static function cargarPresupuesto($id, $valor)
  {
    $dato = Presupuesto::find($id);
    $dato->valor_actual = $dato->valor_actual+$valor;

    $porcentaje = ($dato->valor_actual*100)/$dato->valor_inicial;
    $porcentaje = round($porcentaje);

    $dato->porcentaje = $porcentaje;

    $dato->save();
  }







}
