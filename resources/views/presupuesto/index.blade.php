@extends('layouts.app')
@section('content')

	<section class="content-header">
	  <h1>
	    Presupuestos
	    <small>Resumen</small>
	  </h1>

	</section><br>

	<a class="btn btn-app" href="{{ url('presupuestos/create')}}">
  	<i class="fa fa-plus"></i> Añadir
  </a>

	@if(session()->has('message'))
	 <div class="alert alert-success alert-dismissible">
						 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						 <h4><i class="icon fa fa-check"></i> Correcto!</h4>
						 {{session()->get('message')}}
					 </div>
	@endif


	<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<h3 class="box-title">Tabla de Presupuestos</h3>

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
								<th>nombre</th>
								<th>Valor Total</th>
								<th>Valor Actual</th>
								<th>Estado</th>
								<th>Agregar</th>
							</tr>
							@foreach ($datos as $dato)
							<tr>
								<td>{{$dato->id}}</td>
								<td>{{$dato->nombre}}</td>
								<td>{{ number_format($dato->valor_inicial, 0, '', '.') }}</td>
								<td>{{ number_format($dato->valor_actual, 0, '', '.')}}</td>
								<td>
									@if ($dato->porcentaje > 80)
										<div class="progress progress-xs">
											<div class="progress-bar progress-bar-success" style="width: {{$dato->porcentaje}}%"></div>
										</div>
									@elseif ($dato->porcentaje >= 60)
										<div class="progress progress-xs">
											<div class="progress-bar progress-bar-info" style="width: {{$dato->porcentaje}}%"></div>
										</div>
									@elseif ($dato->porcentaje >= 50)
										<div class="progress progress-xs">
											<div class="progress-bar progress-bar-warning" style="width: {{$dato->porcentaje}}%"></div>
										</div>
									@elseif ($dato->porcentaje > 30)
										<div class="progress progress-xs">
											<div class="progress-bar progress-bar-danger" style="width: {{$dato->porcentaje}}%"></div>
										</div>
									@endif
								<td><a href="{{ url('presupuestos/'.$dato->id.'/edit')}}"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</a></td>

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
