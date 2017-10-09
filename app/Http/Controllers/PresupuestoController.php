<?php

namespace App\Http\Controllers;

use App\Model\Presupuesto;
use Illuminate\Http\Request;

class PresupuestoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $datos = Presupuesto::orderBy('id', 'desc')->paginate(30);
      return view('presupuesto.index',['datos' => $datos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('presupuesto.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->Validate($request,[
          'nombre' => 'required|',
          'valor' => 'required|numeric|min:1|',
      ]);

      $dato = new Presupuesto;
      $dato->nombre  = $request->nombre;
      $dato->valor_inicial = $request->valor;
      $dato->valor_actual = $request->valor;
      $dato->porcentaje = 100;
      $dato->save();

      session()->flash('message', 'Guardado correctamente');
      return redirect('presupuestos');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Presupuesto  $presupuesto
     * @return \Illuminate\Http\Response
     */
    public function show(Presupuesto $presupuesto)
    {
        return view('presupuesto.show', compact('presupuesto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Presupuesto  $presupuesto
     * @return \Illuminate\Http\Response
     */
    public function edit(Presupuesto $presupuesto)
    {
        return view('presupuesto.show', compact('presupuesto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Presupuesto  $presupuesto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Presupuesto $presupuesto)
    {
      $this->Validate($request,[
          'nombre' => 'required|',
          'valor' => 'required|numeric|min:1|',
      ]);

      $dato = Presupuesto::find($presupuesto->id);

      $valor_inicial =$dato->valor_inicial+$request->valor;
      $valor_actual  = $dato->valor_actual+$request->valor;
      $porcentaje = ($valor_actual*100)/$valor_inicial;

      $dato->nombre  = $request->nombre;
      $dato->valor_inicial = $valor_inicial;
      $dato->valor_actual = $valor_actual;
      $dato->porcentaje = $porcentaje;
      $dato->save();

      session()->flash('message', 'Guardado correctamente');
      return redirect('presupuestos');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Presupuesto  $presupuesto
     * @return \Illuminate\Http\Response
     */
    public function editar($id)
    {
        $presupuesto = Presupuesto::find($id);
        return view('presupuesto.edit', compact('presupuesto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Presupuesto  $presupuesto
     * @return \Illuminate\Http\Response
     */
    public function actualizar(Request $request, $id)
    {
      
      $this->Validate($request,[
          'nombre' => 'required',
          'valor_inicial' => 'required|numeric|',
          'valor_actual' => 'required|numeric|',
          'porcentaje' => 'required|numeric|'
      ]);     

      $dato = Presupuesto::find($id);     

      $dato->nombre  = $request->nombre;
      $dato->valor_inicial = $request->valor_inicial;
      $dato->valor_actual = $request->valor_actual;
      $dato->porcentaje = $request->porcentaje;
      $dato->save();

      session()->flash('message', 'Guardado correctamente');
      return redirect('presupuesto/'.$dato->id.'/edit');
       
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Presupuesto  $presupuesto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Presupuesto $presupuesto)
    {
        //
    }
}
