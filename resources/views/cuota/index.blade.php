@extends('layouts.app')
@section('content')

	<section class="content-header">
	  <h1>
	    Cuotas
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
<div style="position: fixed; z-index: 100; width: 90%;" >
 <div class="col-md-3" >
  <div class="box box-info box-solid">
    <div class="box-header with-border">
      <h3 class="box-title">Cantidad sumada</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
      </div>
      <!-- /.box-tools -->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
    $ <input type="number" id="total" value="0" style="background: none; border: none;" disabled>
	</div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>

</div>

 
 <div class="col-md-3" style="height: 93px;" ></div> 


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
								{{--<th>ID</th>--}}
								<th>Fecha Cuota</th>
								<th>Cliente</th>
								<th>Couta</th>								
								<th>Select</th>								 
							</tr>
						 	@foreach($cuotas as $cuota)
							<tr>
							{{--<td>{{$cuota->id}}</td>--}}
								<td>{{$cuota->fecha_cuota}}</td>
								<td>{{$cuota->prestamo->cliente->nombre}}</td>
								<td id="cuota" >{{$cuota->valor_couta}}</td>								
								<td><input type="checkbox" id="{{$cuota->id}}" class="seleccion" value="{{$cuota->valor_couta}}"></td>
								</tr>
							@endforeach 
						</table>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
		</div>


 

 



<script type="text/javascript">
$(document).ready(function()
{

	$(".seleccion").click(function () {

		var totales =  parseInt($("#total").val());
		var dato = parseInt($(this).val()); 
        var id = parseInt($(this).attr('id'));

		if( $(this).is(':checked') ){          
        	
        	resultado = totales+dato;  
			$("#total").val(resultado);

	    } else {
	    	resultado = totales-dato;  
			$("#total").val(resultado);
	    }			
	});	


});


function sumar(id, dato)
{
		 
	
 
}
 


</script>		
 

@endsection
