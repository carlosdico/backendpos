@extends('main')

@section('headers')

	<link href="statics/css/smoothness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" type="text/css" />
	<script src="statics/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="statics/development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="statics/development-bundle/ui/jquery.ui.datepicker.js"></script>

	<script>
		
		$.datepicker.regional['es'] = {
			 closeText: 'Cerrar',
			 prevText: '<Ant',
			 nextText: 'Sig>',
			 currentText: 'Hoy',
			 monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
			 monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
			 dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
			 dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
			 dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
			 weekHeader: 'Sm',
			 dateFormat: 'dd/mm/yy',
			 firstDay: 1,
			 isRTL: false,
			 showMonthAfterYear: false,
			 yearSuffix: ''
		};
		
		$.datepicker.setDefaults($.datepicker.regional['es']);
		
		$(function () {

			$( "#data_one" ).datepicker();
			$( "#data_two" ).datepicker();

		});

	</script>	

	<style>
		div.ui-datepicker{
			font-size:12px;
		}
		#data_one{
			size: 5;

		} 

	</style>

@overwrite

@section('content')

<h3>Cierres de caja</h3> <br>

<div class="input-group input-group-sm">
	</div>
	{!! Form::open(array('url' => 'closedcash', 'method' => 'post')) !!}
	<div class="input-group">
	
	    <span class="input-group-addon glyphicon glyphicon-calendar" id="sizing-addon3"></span>
		<input type="text" class="form-control" name="date_one" id="data_one" value="{{ $date_one }}" size="1">
		<span class="input-group-addon glyphicon glyphicon-calendar" id="sizing-addon3"></span>
		<input type="text" class="form-control" name="date_two" id="data_two" value="{{ $date_two }}" size="1">
	
	 	<div class="input-group-btn">
	    <!-- Buttons -->
	    <button class="btn btn-default" type="submit">>>
				    
	  	</button>
	 	</div>
	</div>
	{!! Form::close() !!} 
	<div align="right">
	{!! Form::open(array('url' => 'ticketspdf', 'method' => 'post', 'target' => '_blank')) !!}
		<input type="hidden" class="form-control" name="date_one" id="data_one" value="{{ $date_one }}" size="1">
		<input type="hidden" class="form-control" name="date_two" id="data_two" value="{{ $date_two }}" size="1">
		
		<button type="submit" class="btn">
               <i class="fa fa-file-pdf-o"></i>
        </button>

	{!! Form::close() !!} 	

	</div>
    
<table class="table table-hover">

<tr>
<th>Nº Cierre</th>
<th>Inicio</th>
<th>Cierre</th>

<th></th>

</tr>

@foreach ($closedcashs as $closedcash)

<tr>
<td>{{ $closedcash->HOSTSEQUENCE }}</td>
<td>{{ date('d-m-Y H:m:s', strtotime($closedcash->DATESTART)) }}</td>
<td>{{ date('d-m-Y H:m:s', strtotime($closedcash->DATEEND)) }}</td>

<td><strong> </strong></td>
<td> </td>
<td>
<a href="/closedcash/{{ $closedcash->MONEY }}"><i class="glyphicon glyphicon-eye-open"></i></a>	
</td>

</tr>

@endforeach 



</table>

@overwrite
