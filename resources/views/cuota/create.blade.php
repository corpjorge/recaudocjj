@extends('layouts.app')
@section('content')

	<section class="content-header">
	  <h1>
	    Pagar Cuota
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
      <h3 class="box-title">Pagar Cuota</h3>
    </div>
    <div class="overlay" id="carga" style="display:none;">
      <i class="fa fa-refresh fa-spin"></i>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
	 {!! Form::open(['url' => 'cuotas/'.$cuota->id, 'method' => 'put']) !!}
    <div role="form">
      <div class="box-body">
        <div class="form-group">
          <label for="valor_cancelado">Valor a pagar</label>
          <input type="number" class="form-control" id="valor_cancelado" placeholder="$" name="valor_cancelado" min="1">
        </div>
				<div class="form-group">
          <label for="nombre">Fecha</label>
          <input type="date" class="form-control" id="fecha_pago" name="fecha_pago">
        </div>
        <div class="form-group">
          <label for="observaciones">Observaciones</label>
          <input type="text" class="form-control" id="observaciones"   name="observaciones" >
        </div>

      </div>
      <!-- /.box-body -->
      <div class="box-footer">
				<button type="submit" class="btn btn-primary" id="pagar_cuota" >Pagar cuota</button>
				<a href="javascript:history.back()"  class="btn btn-default">Cancelar</a>
      </div>
    </div>
		{!! Form::close() !!}
  </div>
 



 
<script>
$(function(){
 $("#pagar_cuota").click(function(){

   valor_cancelado    = $("#valor_cancelado").val();
   fecha_pago   = $("#fecha_pago").val();

   if (valor_cancelado && fecha_pago) {
     $("#carga").show();
   }
 });
});
</script>

@endsection
