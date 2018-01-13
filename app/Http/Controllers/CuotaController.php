<?php

namespace App\Http\Controllers;

use App\Model\Cuota;
use App\Model\Prestamo;
use App\Model\Presupuesto;
use Illuminate\Http\Request;


class CuotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $cuotas = Cuota::where('estado_id','!=','2')->get(); 
         return view('cuota.index',['cuotas' => $cuotas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Cuota  $cuota
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      Cuota::generarAtrasos();
      $prestamo = Prestamo::find($id);
      $coutas = Cuota::where('prestamo_id',$id)->orderBy('cuota', 'desc')->get();
      return view('cuota.show', compact('prestamo'), ['coutas' => $coutas ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Cuota  $cuota
     * @return \Illuminate\Http\Response
     */
    public function edit(Cuota $cuota)
    {
      return view('cuota.create', compact('cuota'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Cuota  $cuota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cuota $cuota)
    {

        $this->Validate($request,[
            'fecha_pago' => 'required|date',
            'valor_cancelado' => 'required|numeric|min:1|',
        ]);

        Cuota::generarCuota($request, $cuota);
        Presupuesto::cargarPresupuesto($cuota->prestamo->presupuesto_id, $request->valor_cancelado);

        session()->flash('message', 'Guardado correctamente');
        return redirect('cuotas/'.$cuota->prestamo_id);

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Cuota  $cuota
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cuota $cuota)
    {
        //
    }
}
