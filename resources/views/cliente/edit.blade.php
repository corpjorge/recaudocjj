@extends('layouts.app')
@section('content')

	<section class="content-header">
	  <h1>
	    Modificar Cliente
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

	@if(session()->has('message'))
	 <div class="alert alert-success alert-dismissible">
						 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						 <h4><i class="icon fa fa-check"></i> Correcto!</h4>
						 {{session()->get('message')}}
					 </div>
	@endif

	<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Modificar Cliente</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
	 {!! Form::open(['url' => 'clientes/'.$cliente->id, 'method' => 'put' ]) !!}
    <div role="form">
      <div class="box-body">
        <div class="form-group">
          <label for="Código">Codigo</label>
          <input type="number" class="form-control" id="codigo" placeholder="Ingresar código" name="codigo" min="1" value="{{$cliente->codigo}}">
        </div>
				<div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" class="form-control" id="nombre" placeholder="Ingresar nombre completo" name="nombre" value="{{$cliente->nombre}}">
        </div>

      </div>
      <!-- /.box-body -->
      <div class="box-footer">
				<button type="submit" class="btn btn-primary">Modificar</button>
				<a href="{{ url('clientes')}}"  class="btn btn-default">Atras</a>
      </div>
    </div>
		{!! Form::close() !!}
  </div>


@endsection
