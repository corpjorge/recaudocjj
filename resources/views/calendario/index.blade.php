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
 
    






 <section class="content container-fluid">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">
        <div class="box-body no-padding">
          <div id="calendar"></div>
        </div>
      </div>
    </div>
   </div>
</section>

<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Filtrar fechas</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
   {!! Form::open(['url' => 'cuotas-filtrar']) !!}
    <div role="form">
      <div class="box-body">
        <div class="form-group {{ $errors->has('fecha') ? ' has-error' : '' }}">
                <label>Rango de fecha</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right reservation" id="reservation" name='fecha' value="{{ old('fecha') }}">
                </div>
              </div>

      </div>
      <!-- /.box-body -->
      <div class="box-footer">
        <button type="submit" class="btn btn-primary" >Filtrar</button>        
      </div>
    </div>
    {!! Form::close() !!}
  </div>



<script src="{{ asset('bower_components/moment/moment.js')}}"></script>
<script src="{{ asset('bower_components/fullcalendar/dist/fullcalendar.min.js')}}"></script>
<script>

  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function init_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    init_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()

        console.log(date);
    $('#calendar').fullCalendar({

      eventRender: function(eventObj, $el) {
        $el.popover({
          title: eventObj.title,
          content: eventObj.description,
          trigger: 'hover',
          placement: 'top',
          container: 'body'
        });
      },      
      
      header    : {
        left  : 'prev,next today',
        center: 'title',
        right : 'month,listWeek,agendaDay'
      },
      buttonText: {
        today: 'hoy',
        month: 'mes',
        week : 'semana',
        day  : 'dia'
      },
      //Random default events
      events    : [   
        @foreach($rows as $row)
        <?php

                  $fecha = Carbon\Carbon::parse($row->fecha_cuota);                    
                  $dtVancouver = Carbon\Carbon::now();
                  $fecha = $fecha->diffInDays($dtVancouver); 
 
                  ?>  
        @if ($row->estado_id == 3 OR $row->estado_id == 4) 
          {           
                title          : '{{$row->prestamo->cliente->nombre}}-({{$fecha}})atrasado',
                start          : '{{$row->fecha_cuota}}',                
                allDay         : false,
                url            : "{{ url('cuotas/'.$row->id.'/edit')}}",   
                @if ($row->estado_id == 3)             
                backgroundColor: '#ffa600',
                borderColor    : '#ffa600',  
                @else
                backgroundColor: '#D90000',
                borderColor    : '#D90000',
                @endif
                description: '${{$row->valor_couta}}-({{$fecha}}) dias de atrasado'   
          },
          @endif
          @endforeach 
      ],
      
      editable  : true,
      droppable : false, // this allows things to be dropped onto the calendar !!!
      drop      : function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject')

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject)

        // assign it the date that was reported
        copiedEventObject.start           = date
        copiedEventObject.allDay          = allDay
        copiedEventObject.backgroundColor = $(this).css('background-color')
        copiedEventObject.borderColor     = $(this).css('border-color')

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true)

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove()
        }

      }
    })

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    //Color chooser button
    var colorChooser = $('#color-chooser-btn')
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      //Save color
      currColor = $(this).css('color')
      //Add color effect to button
      $('#add-new-event').css({ 'background-color': currColor, 'border-color': currColor })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      //Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      //Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.html(val)
      $('#external-events').prepend(event)

      //Add draggable funtionality
      init_events(event)

      //Remove event from text input
      $('#new-event').val('')
    })
  })
</script>

@endsection
