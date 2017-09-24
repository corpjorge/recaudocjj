@extends('layouts.app')
@section('content')

	<section class="content-header">
	  <h1>
	    Presupuesto
	    <small>Resumen</small>
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
 			<h3 class="box-title">Ingresar Presupuesto</h3>
 		</div>
 		<!-- /.box-header -->
 		<!-- form start -->
 	 {!! Form::open(['url' => 'presupuestos/'.$presupuesto->id, 'method' => 'put']) !!}
 		<div role="form">
 			<div class="box-body">
 				<div class="form-group">
 					<label for="nombre">Nombre</label>
 					<input type="text" class="form-control" name="nombre" value="{{$presupuesto->nombre}}">
 				</div>
 				<div class="form-group">
 					<label for="valor">Agregar Valor</label>
 					<input type="number" class="form-control" id="valor" placeholder="$" name="valor" min="1">
 				</div>
 			</div>
 			<!-- /.box-body -->
 			<div class="box-footer">
 				<button type="submit" class="btn btn-primary">Añadir</button>
 				<a href="{{ url('presupuestos')}}"  class="btn btn-default">Cancelar</a>
 			</div>
 		</div>
 		{!! Form::close() !!}
 	</div>



@endsection
