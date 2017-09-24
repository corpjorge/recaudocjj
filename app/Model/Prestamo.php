<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
  public function cliente()
  {
       return $this->belongsTo('App\Model\Cliente','cliente_id');
  }

  public function estado()
  {
       return $this->belongsTo('App\Model\Estado','estado_id');
  }

  public static function saldototal($id, $valorPago)
  {
    $dato = Prestamo::find($id);
    $dato->saldo = $dato->saldo-$valorPago;
    $dato->save();
    return $dato;
  }

  public static function cerrarPrestamo($id)
  {
    $dato = Prestamo::find($id);
    $dato->estado_id = 1;
    $dato->save();
    return $dato;
  }

  public static function ganancia()
  {
    $dato = Prestamo::sum('ganancia');
    return $dato;
  }

  public static function entregado()
  {
    $dato = Prestamo::sum('entregado');
    return $dato;
  }


}
