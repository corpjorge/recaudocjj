@extends('layouts.app')
@section('content')

	<section class="content-header">
	  <h1>
	    Clientes
	    <small>Resumen</small>
	  </h1>

	</section><br>


	<a class="btn btn-app" href="{{ url('clientes/create')}}">
  	<i class="fa fa-plus"></i> Añadir
  </a>

	@isset($limpiar)
		<a class="btn btn-app" href="{{ url('clientes')}}">
	  	<i class="fa fa-eraser"></i>Limpiar
	  </a>
	@endisset

	@if (count($errors) > 0)
			<div class="alert alert-danger">
					<strong>Error!</strong><br><br>
					<ul>
							@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
							@endforeach
					</ul>
			</div>
	@endif


	<div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Tabla de clientes</h3>
            <div class="box-tools">
							{!! Form::open(['url' => 'clientes/buscar']) !!}
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="dato" class="form-control pull-right" placeholder="Nombre">
                <div class="input-group-btn">
                  	<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
              </div>
							{!! Form::close() !!}
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
              <tr>
                <th>ID</th>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Prestamos</th>
                <th>Prestar</th>
              </tr>
							@foreach ($clientes as $cliente)
              <tr>
                <td>{{$cliente->id}}</td>
                <td>{{$cliente->codigo}}</td>
                <td>{{$cliente->nombre}}</td>
                <td><a href="{{ url('prestamos/'.$cliente->id)}}"><i class="fa fa-search" aria-hidden="true"></i> Ver</a></td>
                <td><a href="{{ url('prestamos/create/'.$cliente->id)}}"><i class="fa fa-money" aria-hidden="true"></i> Prestar</a></td>
              </tr>
							@endforeach
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
    </div>
		{{ $clientes->links() }}


@endsection
