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
