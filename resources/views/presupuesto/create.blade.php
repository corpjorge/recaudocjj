@extends('layouts.app')
@section('content')

	<section class="content-header">
	  <h1>
	    Presupuesto
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
			<h3 class="box-title">Ingresar Presupuesto</h3>
		</div>
		<!-- /.box-header -->
		<!-- form start -->
	 {!! Form::open(['url' => 'presupuestos', 'id' => 'formulario']) !!}
		<div role="form">
			<div class="box-body">
				<div class="form-group">
					<label for="nombre">Nombre</label>
					<input type="text" class="form-control" name="nombre" id="nombre">
				</div>
				<div class="form-group">
					<label for="valor">Valor</label>
					<input type="number" class="form-control" id="valor" placeholder="$" name="valor" min="1">
				</div>
			</div>


				<div class="box-footer">
					 <button id="modal" type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Añadir</button>
					<a href="{{ url('presupuestos')}}"  class="btn btn-default">Cancelar</a>
				</div>

			  <!-- Modal -->
			  <div class="modal fade" id="myModal" role="dialog">
			    <div class="modal-dialog modal-sm">
			      <div class="modal-content">
			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          <h4 class="modal-title">Confirmar</h4>
			        </div>
			        <div class="modal-body">
			          Nombre: <p id="confirmarNombre"></p>
								Valor: <p id="confirmarValor"></p>
			        </div>
			        <div class="modal-footer">
			          <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
								<button type="submit" class="btn btn-primary">Añadir</button>
			        </div>
			      </div>
			    </div>
			  </div>




		</div>



		{!! Form::close() !!}
	</div>

<script type="text/javascript">

$(document).ready(function() {
	$('#modal').click(function(){
		var nombre = $("#nombre").val()
		var valor = $("#valor").val()

		var vacio = 'Vacio';

		if(nombre == '') {
			$('#confirmarNombre').text(vacio);
		}
		else {
			$('#confirmarNombre').text(nombre);
		}

		if(valor == '') {
			$('#confirmarValor').text(vacio);
		}
		else {
			$('#confirmarValor').text(valor);
		}


	});
});

</script>




@endsection
