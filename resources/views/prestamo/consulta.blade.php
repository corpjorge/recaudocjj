@extends('layouts.app')
@section('content')

	<section class="content-header">
	  <h1>
	    Buscar ganancia mensual
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

<div class="row">

	<div class="col-md-3 col-sm-6 col-xs-12">
	 <div class="info-box">
		 <span class="info-box-icon bg-orange"><i class="fa fa-flag-o"></i></span>

		 <div class="info-box-content">
			 <span class="info-box-text">Ganancia Total</span>
			 <span class="info-box-number">{{ number_format($total, 0, '', '.')}}</span>
		 </div>
		 <!-- /.info-box-content -->
	 </div>
	 <!-- /.info-box -->
	</div>
</div>

@if(session()->has('message'))
 <div class="alert alert-danger alert-dismissible">
					 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					 <h4><i class="icon fa fa-window-close"></i> Error!</h4>
					 {{session()->get('message')}}
				 </div>
@endif


	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Buscar</h3>
		</div>
		<!-- /.box-header -->
		<!-- form start -->
	 {!! Form::open(['url' => 'prestamo/consulta']) !!}
		<div role="form">
			<div class="box-body">
				<div class="form-group">
          <label>Mes</label>
          <select class="form-control" name="mes" required>
						<option value=""></option>
						<option value="01">Enero</option>
						<option value="02">Febrero</option>
						<option value="03">Marzo</option>
						<option value="04">Abril</option>
						<option value="05">Mayo</option>
						<option value="06">Junio</option>
						<option value="07">Julio</option>
						<option value="08">Agosto</option>
						<option value="09">Septiembre</option>
						<option value="10">Octubre</option>
						<option value="11">Noviembre</option>
						<option value="12">Diciembre</option>
          </select>
        </div>

				<div class="form-group">
					<label for="ano">Año</label>
					<input type="number" class="form-control" id="ano" placeholder="2017" name="ano" min="2000" max="2050" required>
				</div>

			</div>
				<div class="box-footer">
					 <button type="submit" class="btn btn-primary">Buscar</button>
					<a href="{{ url('home')}}"  class="btn btn-default">Cancelar</a>
				</div>
			  <!-- Modal -->
		</div>



		{!! Form::close() !!}
	</div>

	@isset($ganancia)
	<div class="pad margin no-print">
     <div class="callout callout-info" style="margin-bottom: 0!important;">
       <h4><i class="fa fa-info"></i> Resultado:</h4>
       Ganancias del mes de {{ $mes }} - {{$ano}} son:  {{ number_format($ganancia, 0, '', '.')}}
     </div>
   </div>
	 @endisset




@endsection
