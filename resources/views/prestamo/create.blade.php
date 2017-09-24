@extends('layouts.app')
@section('content')

	<section class="content-header">
	  <h1>
	    Prestar
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
	 <div class="alert alert-danger alert-dismissible">
						 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						 <h4><i class="icon fa fa-check"></i> Error!</h4>
						 {{session()->get('message')}}
					 </div>
	@endif



	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Ingresar préstamo</h3>
		</div>
		<!-- /.box-header -->
		<!-- form start -->
	 {!! Form::open(['url' => 'prestamos/'.$cliente->id]) !!}
		<div role="form">
			<div class="box-body">
				<div class="form-group">
					<label for="">Nombre</label>
					<input type="text" class="form-control" value="{{$cliente->nombre}}" disabled>
				</div>
				<div class="form-group">
          <label>Presupuesto</label>
          <select class="form-control" name="presupuesto" required>
						@foreach ($presupuestos as $presupuesto)
            <option value=""></option>
						<option value="{{$presupuesto->id}}">{{$presupuesto->nombre}} - {{ number_format($presupuesto->valor_actual, 0, '', '.') }}</option>
						@endforeach
          </select>
        </div>
				<div class="form-group">
					<label for="prestamo">Prestamo</label>
					<input type="number" class="form-control" id="prestamo" placeholder="$" name="prestamo" min="1">
				</div>
				<div class="form-group">
					<label for="fecha">Fecha primer pago</label>
					<input type="date" class="form-control" id="fecha" placeholder="fecha" name="fecha">
				</div>
				<div class="form-group">
					<label for="cuota">Cuotas</label>
					<input type="number" class="form-control" id="cuota" placeholder="Semanas" name="cuota" min="1">
				</div>
				<div class="form-group">
					<label for="interes">Interes</label>
					<input type="number" class="form-control" id="interes" placeholder="%" name="interes" min="1">
				</div>
				<div class="form-group">
					<label for="observaciones">Observaciones</label>
					<input type="text" class="form-control" id="observaciones" placeholder="observaciones" name="observaciones">
				</div>

			</div>
			<!-- /.box-body -->
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Realizar préstamo</button>
				<a href="{{ url('clientes')}}"  class="btn btn-default">Cancelar</a>
			</div>
		</div>
		{!! Form::close() !!}
	</div>




@endsection
