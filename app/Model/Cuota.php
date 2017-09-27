<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Prestamo;
use Carbon\Carbon;


class Cuota extends Model
{
  public function estado()
  {
       return $this->belongsTo('App\Model\Estado','estado_id');
  }

  public function prestamo()
  {
       return $this->belongsTo('App\Model\Prestamo','prestamo_id');
  }

  public static function fechaProxiCuota($fecha)
  {
    $fecha = Carbon::parse($fecha);
    $fecha = $fecha->addDays(7)->format('Y-m-d');
    return $fecha;
  }

  public static function guardarCuota($cuota, $request)
  {
    $dato = Cuota::find($cuota);
    $dato->fecha_pago  = $request->fecha_pago;
    $dato->valor_cancelado = $request->valor_cancelado;
    $dato->estado_id = 2;
    $dato->save();
    $cuotaGuardada = $dato;
    return $cuotaGuardada;
  }

  public static function nuevaCuota($cuota, $fechaCuota, $comando = 0)
  {
    $saldo = Cuota::saldo($cuota->valor_couta,$cuota->valor_cancelado);
    $cuotas= $cuota->prestamo->prestamo/$cuota->prestamo->cuota;

    $cuota_new = new Cuota;
    $cuota_new->prestamo_id = $cuota->prestamo_id;
    $cuota_new->cuota = $cuota->cuota+1;
    if ($cuota->cuota >= $cuota->prestamo->cuota) {
      $cuota_new->valor_couta = $saldo;
    }
    // if($comando == 1){
    //   $cuota_new->valor_couta = $cuotas;
    // }
    else {
      $cuota_new->valor_couta = $cuotas+$saldo;
    }
    $cuota_new->fecha_cuota = $fechaCuota ;
    $cuota_new->estado_id  = 3;
    $cuota_new->save();
  }

  public static function ActualizarNuevaCuota($id, $cuota)
  {
    $saldo = Cuota::saldo($cuota->valor_couta,$cuota->valor_cancelado);
    $cuotas= $cuota->prestamo->prestamo/$cuota->prestamo->cuota;

    $actualizarCuota = Cuota::find($id);
    if ($cuota->cuota >= $cuota->prestamo->cuota) {
      $actualizarCuota->valor_couta = $saldo;
    }
    else {
      $actualizarCuota->valor_couta = $cuotas+$saldo;
    }
    $actualizarCuota->save();

  }


  public static function saldo($valorUltimaCouta,$valorCancelado)
  {
    $saldo = $valorUltimaCouta-$valorCancelado;
    return $saldo;
  }

  public static function cuotaExist($prestamo, $fecha)
  {
    $cuotaExist = Cuota::where('prestamo_id',$prestamo)->where('fecha_cuota','=', $fecha)->first();
    return $cuotaExist;
  }


  public static function generarCuota($request, $cuota)
  {

    $cuotaGuardada = Cuota::guardarCuota($cuota->id, $request);
    $fechaCuota = Cuota::fechaProxiCuota($cuota->fecha_cuota);
    $cuotaExist = Cuota::cuotaExist($cuota->prestamo_id, $fechaCuota);
    $saldototal = Prestamo::saldototal($cuota->prestamo->id,$request->valor_cancelado);

    if ($saldototal->saldo > 0 ) {
      if (!$cuotaExist ) {
        Cuota::nuevaCuota($cuotaGuardada, $fechaCuota);
      }
      else {
        Cuota::ActualizarNuevaCuota($cuotaExist->id, $cuotaGuardada );
      }
    }else {
        Prestamo::cerrarPrestamo($cuota->prestamo->id);
    }

   }

   public static function generarCuotas()
   {
     $hoy = $carbon = Carbon::now();
     $hoy = $hoy->format('Y-m-d');
     $fechaProxiCuota = Cuota::fechaProxiCuota($carbon);
     $cuotas = Cuota::cuotasDia($hoy);
     $comando = 1;
     foreach ($cuotas as $cuota) {
        $cuotaExist = Cuota::cuotaExist($cuota->prestamo_id, $fechaProxiCuota);
       if (!$cuotaExist ) {
           Cuota::nuevaCuota($cuota, $fechaProxiCuota, $comando);
       }
     }

   }

   public static function cuotasDia($hoy)
   {
     $cuotas = Cuota::where('fecha_cuota','=',$hoy)->orderBy('id', 'desc')->get();
     return $cuotas;
   }

   public static function generarAtrasos()
   {
     $hoy = $carbon = Carbon::now();
     $hoy = $hoy->format('Y-m-d');
     $atrasadas = Cuota::atrasadas($hoy);

     foreach ($atrasadas as $atrasado) {
       cuota::Actualizaratrasados($atrasado);
     }

   }


   public static function atrasadas($hoy)
   {
     $atrasadas = Cuota::where('fecha_cuota','<',$hoy)->where('estado_id','=',3)->orderBy('id', 'desc')->get();
     return $atrasadas;
   }

   public static function Actualizaratrasados($atrasado)
   {
       $dato = Cuota::find($atrasado->id);
       $dato->estado_id  = 4;
       $dato->save();
   }

   public static function atrasadasTotal()
   {
     $atrasadas = Cuota::where('estado_id','=',4)->orderBy('id', 'desc')->paginate(30);
     return $atrasadas;
   }

   public static function pagosHoy($hoy)
   {
     $pagoHoy = Cuota::where('fecha_cuota','=',$hoy)->where('estado_id','=',3)->orderBy('id', 'desc')->paginate(30);
     return $pagoHoy;
   }








}
