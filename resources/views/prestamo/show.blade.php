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

	<div class="box box-widget widget-user-2">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header bg-yellow">
        <div class="widget-user-image">
          {{-- <img class="img-circle" src="../dist/img/user7-128x128.jpg" alt="User Avatar"> --}}
        </div>
        <!-- /.widget-user-image -->
        <h3 class="widget-user-username">{{$cliente->nombre}}</h3>
        <h5 class="widget-user-desc">{{$cliente->codigo}}</h5>
      </div>
      <div class="box-footer no-padding">

      </div>
    </div>

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
								<th>Prestamo</th>
								<th>Saldo</th>
								<th>fecha</th>
								<th>cuota</th>
								<th>interes</th>
								<th>observaciones</th>
								<th>Estado</th>
								<th>Cuotas</th>
							</tr>
							@foreach ($prestamos as $prestamo)
							<tr>
								<td>{{$prestamo->id}}</td>
								<td>{{ number_format($prestamo->prestamo, 0, '', '.')}}</td>
								<td>{{ number_format($prestamo->saldo, 0, '', '.')}}</td>
								<td>{{$prestamo->fecha}}</td>
								<td>{{$prestamo->cuota}}</td>
								<td>{{$prestamo->interes}}%</td>
								<td>{{$prestamo->observaciones}}</td>
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
