<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Cuota;
use App\Model\Presupuesto;
use App\Model\Prestamo;

use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Cuota::generarAtrasos();
        $carbon = Carbon::now();
        $hoy = $carbon->format('Y-m-d');
        $ano = $carbon->format('Y');
        $mes = $carbon->format('m');

        $presupuesSuma = Presupuesto::presupuesSuma();
        $porcentaje = Presupuesto::porcentaje();
        $atrasadas = Cuota::atrasadasTotal();
        $pagoHoy = Cuota::pagosHoy($hoy);
        $ganancia = Prestamo::ganancia($mes, $ano);
        $entregado = Prestamo::entregado();return view('home', compact('presupuesSuma', 'porcentaje','hoy','ganancia','entregado'), ['atrasadas' => $atrasadas, 'pagoHoy' => $pagoHoy]);
    }
}
