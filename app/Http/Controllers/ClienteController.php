<?php

namespace App\Http\Controllers;

use App\Model\Cliente;
use App\Model\Presupuesto;
use Illuminate\Http\Request;


class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::orderBy('id', 'desc')->paginate(30);
        return view('cliente.index',['clientes' => $clientes]);
    }


    public function buscar(Request $request)
    {
        $clientes = Cliente::where('nombre','LIKE', '%'.$request->dato.'%')->paginate(30);
        $limpiar = 1;
        return view('cliente.index',compact('limpiar'),['clientes' => $clientes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cliente.create');
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
            'codigo' => 'required|numeric|min:1|unique:clientes',
            'nombre' => 'required|',
        ]);

        $cliente = new Cliente;
        $cliente->codigo  = $request->codigo;
        $cliente->nombre = $request->nombre;
        $cliente->save();
        return redirect('prestamos/create/'.$cliente->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Ejemplo: calcula el 20% de 60:
        // 20% de 60 = (20 x 60) / 100 = 12
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
