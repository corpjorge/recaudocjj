<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
  public function presupuesto()
  {
       return $this->belongsTo('App\Model\Presupuesto','presupuesto_id');
  }

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

  public static function ganancia($mes, $ano)
  {
    $dato = \DB::select('select SUM(ganancia) as ganancia from prestamos where MONTH(fecha) = :MES AND YEAR(fecha) = :ANO', ['MES' => $mes, 'ANO' => $ano]);
    $dato = $dato[0]->ganancia;
    return $dato;
  }

  public static function gananciaTotal()
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
