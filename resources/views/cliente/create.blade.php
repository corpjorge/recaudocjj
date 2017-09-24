@extends('layouts.app')
@section('content')

	<section class="content-header">
	  <h1>
	    Ingresar Cliente
	    <small></small>
	  </h1>
	  
	</section><br>

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

	<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Agregar Cliente</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
	 {!! Form::open(['url' => 'clientes']) !!}
    <div role="form">
      <div class="box-body">
        <div class="form-group">
          <label for="Código">Codigo</label>
          <input type="number" class="form-control" id="codigo" placeholder="Ingresar código" name="codigo" min="1">
        </div>
				<div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" class="form-control" id="nombre" placeholder="Ingresar nombre completo" name="nombre">
        </div>

      </div>
      <!-- /.box-body -->
      <div class="box-footer">
				<button type="submit" class="btn btn-primary">Guardar y Prestar</button>
				<a href="{{ url('clientes')}}"  class="btn btn-default">Cancelar</a>
      </div>
    </div>
		{!! Form::close() !!}
  </div>


@endsection
