@extends('layouts.app')
@section('content')

	<section class="content-header">
	  <h1>
	    Prestamos
	    <small>Resumen</small>
	  </h1>

	</section><br>


	<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Tabla de clientes</h3>

						<div class="box-tools">
							<div class="input-group input-group-sm" style="width: 150px;">
								<input type="text" name="table_search" class="form-control pull-right" placeholder="Search">

								<div class="input-group-btn">
									<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
								</div>
							</div>
						</div>
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


@endsection
