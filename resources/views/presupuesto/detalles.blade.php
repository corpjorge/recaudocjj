@extends('layouts.app')
@section('content')

	<section class="content-header">
	  <h1>
	    Prestamos
	    <small>Resumen</small>
	  </h1>
	  
	</section><br>

	<a class="btn btn-app" href="javascript:history.back()">
  	<i class="fa fa-arrow-left"></i> Atras
  </a>

 

	<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Cuotas</h3>
						 
					</div>
					<!-- /.box-header -->
					<div class="box-body table-responsive no-padding">
						<table class="table table-hover">
							<tr>
								<th>ID</th>				
								<th>Cliente</th>				
								<th>Prestamo</th>				
								<th>Saldo</th>				
								<th>Fecha</th>				
							</tr>
							@foreach ($rows as $prestamo)
							<tr>
								<td>{{$prestamo->id}}</td>								
								<td>{{$prestamo->cliente->nombre}}</td>								
								<td>{{$prestamo->prestamo}}</td>								
								<td>{{$prestamo->saldo}}</td>								
								<td>{{$prestamo->fecha}}</td>								
							</tr>
							@endforeach
						</table>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
		</div>


@endsection
