 @extends('layouts.app')
@section('content')

	<section class="content-header">
	  <h1>
	    Cuotas
	    <small>Resumen</small>
	  </h1>
	</section><br>

	<a class="btn btn-app" href="{{ url('prestamos')}}">
  	<i class="fa fa-arrow-left"></i> Atras
  </a>

	<div class="box box-widget widget-user-2">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header bg-yellow">
        <div class="widget-user-image">
          {{-- <img class="img-circle" src="../dist/img/user7-128x128.jpg" alt="User Avatar"> --}}
        </div>
        <!-- /.widget-user-image -->
        <h3 class="widget-user-username">{{$prestamo->cliente->nombre}}</h3>
        <h5 class="widget-user-desc">{{$prestamo->cliente->codigo}}</h5>
      </div>
      <div class="box-footer no-padding">
        <ul class="nav nav-stacked">
          <li><a href="#">Prestamo <span class="pull-right  ">{{ number_format($prestamo->prestamo, 0, '', '.') }}</span></a></li>
          <li><a href="#">Saldo Total <span class="pull-right ">{{ number_format($prestamo->saldo, 0, '', '.')}}</span></a></li>
          <li><a href="#">Ganancia <span class="pull-right ">{{ number_format($prestamo->ganancia, 0, '', '.')}}</span></a></li>
          <li><a href="#">Entregado <span class="pull-right ">{{ number_format($prestamo->entregado, 0, '', '.')}}</span></a></li>
          <li><a href="#">Fecha del prestamo <span class="pull-right">{{$prestamo->fecha}}</span></a></li>
					<li><a href="#">Cuotas <span class="pull-right    ">{{$prestamo->cuota}}</span></a></li>
          <li><a href="#">Interes <span class="pull-right    ">{{$prestamo->interes}}%</span></a></li>
        </ul>
      </div>
    </div>


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
						<h3 class="box-title">Cuotas</h3>

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
								<th>#</th>
								<th>Fecha próximo pago</th>
								<th>Valor a pagar</th>
								<th>Fecha pago realizado</th>
								<th>Valor pagado</th>
								<th>Estado</th>
								<th>Pagar</th>
							</tr>
							@foreach ($coutas as $couta)
							<tr>
								<td>{{$couta->cuota}}</td>
								<td>{{$couta->fecha_cuota}}</td>
								<td>{{number_format($couta->valor_couta, 0, '', '.') }}</td>
								<td>
									@if ($couta->fecha_pago != null)
										{{$couta->fecha_pago}}
									@else
										Sin pagar
									@endif
								</td>
								<td>
									@if ($couta->valor_cancelado != null)
										{{ number_format($couta->valor_cancelado, 0, '', '.') }}
									@else
										0
									@endif
								</td>
								<td><span class="label label-{{$couta->estado->estilo}}">{{$couta->estado->nombre}}</span></td>
								<td>
									@if ($couta->estado->id != 2)
										<a href="{{ url('cuotas/'.$couta->id.'/edit')}}"><i class="fa fa-money" aria-hidden="true"></i> Pagar</a>
									@else
										Realizado
									@endif

								</td>
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
