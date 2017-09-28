@extends('layouts.app')
@section('content')

	<section class="content-header">
	  <h1>
	    Editar Presupuesto
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
			<h3 class="box-title">Editar Presupuesto</h3>
		</div>
		<!-- /.box-header -->
		<!-- form start -->
	 {!! Form::open(['url' => 'presupuesto/'.$presupuesto->id, 'id' => 'formulario']) !!}
		<div role="form">
			<div class="box-body">
				<div class="form-group">
					<label for="nombre">Nombre</label>
					<input type="text" class="form-control" name="nombre" id="nombre" value="{{$presupuesto->nombre}}">
				</div>
				<div class="form-group">
					<label for="valor_inicial">Valor inicial</label>
					<input type="number" class="form-control" id="valor_inicial" placeholder="$" name="valor_inicial" min="1" value="{{$presupuesto->valor_inicial}}">
				</div>
				<div class="form-group">
					<label for="valor_actual">Valor actual</label>
					<input type="number" class="form-control" id="valor_actual" placeholder="$" name="valor_actual" min="1" value="{{$presupuesto->valor_actual}}">
				</div>
				<div class="form-group">
					<label for="porcentaje">Porcentaje</label>
					<input type="number" class="form-control" id="porcentaje" placeholder="%" name="porcentaje" min="1" value="{{$presupuesto->porcentaje}}">
				</div>
			</div>


				<div class="box-footer">
					 <button type="submit" class="btn btn-primary">Modificar</button>
					<a href="{{ url('presupuestos')}}"  class="btn btn-default">Atras</a>
				</div>

		 



		</div>



		{!! Form::close() !!}
	</div>

 




@endsection
