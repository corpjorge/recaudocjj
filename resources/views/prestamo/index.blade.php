@extends('layouts.app')
@section('content')

	<section class="content-header">
	  <h1>
	    Prestamos
	    <small>Resumen</small>
	  </h1>

	</section><br>

	@if(session()->has('message'))
	 <div class="alert alert-success alert-dismissible">
						 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						 <h4><i class="icon fa fa-check"></i> Realizado!</h4>
						 {{session()->get('message')}}
					 </div>
	@endif
{{--
<div class="col-md-3">
	<div class="box">   
	 {!! Form::open(['url' => 'prestamo/buscar']) !!}         
	    <div class="box-body">
	      <p>Buscar</p>
	      <div class="input-group margin">
	        <input type="number" class="form-control" placeholder="Inicio" min="1" name="inicio" required="">	         
	            <span class="input-group-btn">	             
	            </span>
	        <input type="number" class="form-control" placeholder="Fin" min="1" name="fin" required="">	         
	            <span class="input-group-btn">
	              <button type="submit" class="btn btn-info btn-flat">Go!</button>
	            </span>
	      </div>
	      <!-- /input-group -->
	    </div>

	    {!! Form::close() !!}
	    <!-- /.box-body -->
	  </div>
</div>
--}}
	<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Tabla de Prestamos</h3>


					</div>
					<!-- /.box-header -->
					<div class="box-body table-responsive no-padding">
						<table class="table table-hover">
							<tr>
								<th>ID</th>
								<th>Cliente</th>
								<th>Prestamo</th>
								<th>Saldo Total</th>
								<th>Estado</th>
								<th>Cuotas</th>
							</tr>
							@foreach ($prestamos as $prestamo)
							<tr>
								<td>{{$prestamo->id}}</td>
								<td>{{$prestamo->cliente->nombre}}</td>
								<td>{{ number_format($prestamo->prestamo, 0, '', '.')}}</td>
								<td>{{ number_format($prestamo->saldo, 0, '', '.')}}</td>
								<td><span class="label label-{{$prestamo->estado->estilo}}">{{$prestamo->estado->nombre}}</span></td>
								<td><a href="{{ url('cuotas/'.$prestamo->id)}}"><i class="fa fa-search" aria-hidden="true"></i> Ver</a></td>

							</tr>
							@endforeach
						</table>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
		</div>
{{ $prestamos->links() }}

@endsection
