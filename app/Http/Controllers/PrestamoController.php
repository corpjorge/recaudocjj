<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Prestamo;
use App\Model\Cuota;
use App\Model\Cliente;
use App\Model\Presupuesto;

use Carbon\Carbon;


class PrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prestamos = Prestamo::orderBy('id', 'desc')->get();
        return view('prestamo.index',['prestamos' => $prestamos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
      $cliente = Cliente::find($id);
      $presupuestos = Presupuesto::all();
      return view('prestamo.create', compact('cliente'), ['presupuestos' => $presupuestos]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
      $this->Validate($request,[
          'prestamo' => 'required|',
          'fecha' => 'required|date',
          'cuota' => 'required|numeric|min:1|',
          'interes' => 'required|numeric|min:0|',
          'presupuesto' => 'required|numeric|min:1|',
      ]);

      $presupuesto = Presupuesto::find($request->presupuesto);

      if ($presupuesto->valor_actual < $request->prestamo ) {
          session()->flash('message', 'El presupuesto es muy bajo para la cantidad solicitada');
          return redirect('prestamos/create/'.$id);
      }else{

          $ganancia = ($request->interes*$request->prestamo)/100;
          $entregado = $request->prestamo-$ganancia;

          $valor_actual = $presupuesto->valor_actual-$entregado;
          $porcentaje = ($valor_actual*100)/$presupuesto->valor_inicial;
          $porcentaje = round($porcentaje);
          $cuota_valor = $request->prestamo/$request->cuota;

          $presupuesto->valor_actual = $valor_actual;
          $presupuesto->porcentaje = $porcentaje;
          $presupuesto->save();

          $dato = new Prestamo;
          $dato->cliente_id  = $id;
          $dato->prestamo = $request->prestamo;
          $dato->presupuesto_id = $request->presupuesto;
          $dato->saldo = $request->prestamo;
          $dato->fecha = $request->fecha;
          $dato->cuota = $request->cuota;
          $dato->interes = $request->interes;
          $dato->ganancia = $ganancia;
          $dato->entregado = $entregado;
          $dato->observaciones = $request->observaciones;
          $dato->estado_id = 3;
          $dato->save();
          $id_prestamo = $dato->id;

          $dt = Carbon::parse($request->fecha);
          $dt->format('d-m-Y');
          $dt->addDays(7)->format('d-m-Y');

          $cuota = new Cuota;
          $cuota->prestamo_id = $id_prestamo;
          $cuota->cuota = 1;
          $cuota->valor_couta = $cuota_valor;
          $cuota->fecha_cuota = $dt;
          $cuota->estado_id = 3;
          $cuota->save();

          session()->flash('message', 'Guardado correctamente');
          return redirect('prestamos');

      }

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $cliente = Cliente::find($id);
      $prestamos = Prestamo::where('cliente_id',$id)->orderBy('id', 'desc')->get();
      return view('prestamo.show', compact('cliente'), ['prestamos' => $prestamos ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
