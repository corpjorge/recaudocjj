@extends('layouts.app')
@section('content')

	<section class="content-header">
	  <h1>
	    Home
	    <small>Resumen</small>
	  </h1>

	</section><br>



	<div class="row">
     <div class="col-md-3 col-sm-6 col-xs-12">
			 @if ($porcentaje >= 80)
				 <div class="info-box bg-green">
			 @elseif ($porcentaje >= 70)
				 <div class="info-box bg-aqua">
			 @elseif ($porcentaje >= 60)
				 <div class="info-box bg-yellow">
			 @else
				 <div class="info-box bg-red">
			 @endif
         <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

         <div class="info-box-content">
           <span class="info-box-text">Presupuesto Total</span>
           <span class="info-box-number">{{ number_format($presupuesSuma, 0, '', '.')}}</span>

           <div class="progress">
             <div class="progress-bar" style="width:  {{round($porcentaje)}}%"></div>
           </div>
               <span class="progress-description">
                 {{round($porcentaje)}}% Porcentaje
               </span>
         </div>
         <!-- /.info-box-content -->
       </div>
       <!-- /.info-box -->
     </div>
     <!-- /.col -->

		 <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-orange"><i class="fa fa-flag-o"></i></span>

        <div class="info-box-content">
          <span class="info-box-text">Ganancia {{$carbon->format('M')}}</span>
          <span class="info-box-number">{{ number_format($ganancia, 0, '', '.')}}</span> <a href="{{ url('prestamo/consulta') }}">Ver todo</a>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
{{--
		<div class="col-md-3 col-sm-6 col-xs-12">
		 <div class="info-box">
			 <span class="info-box-icon bg-black"><i class="fa fa-money"></i></span>

			 <div class="info-box-content">
				 <span class="info-box-text">Dinero entregado</span>
				 <span class="info-box-number">{{ number_format($entregado, 0, '', '.')}}</span>
			 </div>
			 <!-- /.info-box-content -->
		 </div>
		 <!-- /.info-box -->
	 </div> 
--}}

   </div>

	 <div class="row">
	 		<div class="col-xs-12">
	 			<div class="box">
	 				<div class="box-header">
	 					<h3 class="box-title"><span class="label label-danger">Atrasados</span></h3>


	 				</div>
	 				<!-- /.box-header -->
	 				<div class="box-body table-responsive no-padding">
	 					<table class="table table-hover">
	 						<tr>
	 							<th>#</th>
	 							<th>Clienta</th>
	 							<th>Valor a pagar</th>
	 							<th>Fecha pago</th>
	 							<th>Dias</th>
	 							<th>Obs</th>
	 							<th>Pagar</th>
	 						</tr>
	 						@foreach ($atrasadas as $atrasada)
	 						<tr>
	 							<td>{{$atrasada->id}}</td>
	 							<td>{{$atrasada->prestamo->cliente->nombre}}</td>
	 							<td>{{number_format($atrasada->valor_couta, 0, '', '.') }}</td>
	 							<td>{{$atrasada->fecha_cuota}}</td>
	 							<td>
	 								<?php

	 								$fecha = Carbon\Carbon::parse($atrasada->fecha_cuota);      							
 									$dtVancouver = Carbon\Carbon::now();
									echo $fecha->diffInDays($dtVancouver); 
 
	 								?>	 								
	 							</td>
	 							<td>{{$atrasada->prestamo->observaciones}}</td>
	 							<td>
	 								@if ($atrasada->estado->id != 2)
	 									<a href="{{ url('cuotas/'.$atrasada->id.'/edit')}}"><i class="fa fa-money" aria-hidden="true"></i> Pagar</a>
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
		{{ $atrasadas->links() }}

		<div class="row">
 	 		<div class="col-xs-12">
 	 			<div class="box">
 	 				<div class="box-header">
 	 					<h3 class="box-title">Pagos <span class="label label-warning">{{$hoy}}</span></h3>

 	 				</div>
 	 				<!-- /.box-header -->
 	 				<div class="box-body table-responsive no-padding">
 	 					<table class="table table-hover">
 	 						<tr>
 	 							<th>#</th>
 	 							<th>Cliente</th>
 	 							<th>Valor a pagar</th>
 	 							<th>Estado</th>
 	 							<th>Pagar</th>
 	 						</tr>
 	 						@foreach ($pagoHoy as $Hoy)
 	 						<tr>
 	 							<td>{{$Hoy->id}}</td>
 	 							<td>{{$Hoy->prestamo->cliente->nombre}}</td>
 	 							<td>{{number_format($Hoy->valor_couta, 0, '', '.') }}</td>
 	 							<td><span class="label label-{{$Hoy->estado->estilo}}">{{$Hoy->estado->nombre}}</span></td>
 	 							<td>
 	 								@if ($Hoy->estado->id != 2)
 	 									<a href="{{ url('cuotas/'.$Hoy->id.'/edit')}}"><i class="fa fa-money" aria-hidden="true"></i> Pagar</a>
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
{{ $pagoHoy->links() }}

@endsection
