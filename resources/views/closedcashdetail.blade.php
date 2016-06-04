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

<h3>Cierre de caja - {{ $closedcash->HOSTSEQUENCE }}</h3><p>{{ date('d-m-Y H:m:s', strtotime($closedcash->DATESTART)) }} - {{ date('d-m-Y H:m:s', strtotime($closedcash->DATEEND)) }}</p>  <br>

<div align="right">
         <a href="{{ url('/closedcashdetailpdf')}}/{{ $closedcash->HOSTSEQUENCE }}"><i class="fa fa-file-pdf-o"></i></a>
</div>

<table class="table table-hover">
<tr>
<th>Subtotal</th>
<th>IVA</th>
<th>Total</th>
</tr>
<tr>
<td>{{ round($closed_data['SUBTOTAL'],2) }}<i class="glyphicon-small glyphicon-euro"></i></td>
<td>{{ round($closed_data['IVA'],2) }}<i class="glyphicon-small glyphicon-euro"></i></td>
<td>{{ round($closed_data['TOTAL'],2) }}<i class="glyphicon-small glyphicon-euro"></i></td>
</tr>

</table>

<table class="table table-hover">

<tr>
<th>Usuario</th>
<th>Total</th>
<th>Apertura de cajon</th>
<th>Líneas eliminadas</th>
</tr>

@foreach ($person_data as $person)

<tr>
<td>{{ $person['NAME'] }}</td>
<td>{{ $person['TOTAL'] }}<i class="glyphicon-small glyphicon-euro"></i></td>
<td>{{ $person['DRAWEROPENED'] }}</td>
<td>{{ $person['LINEREMOVED'] }}</td>

<td></td>

</tr>

@endforeach

</table>

<table class="table table-hover">

<tr>
<th>Producto</th>
<th>Unidades</th>
<th>Subtotal</th>
<th>IVA</th>
<th>Total</th>
<th></th>
</tr>

@foreach ($ticketline_data as $line)

<tr>
	<td> {{ $line['NAME'] }} </td>
	<td> {{ $line['UNITS'] }} </td>
	<td> {{ round($line['SUBTOTAL'],2) }} <i class="glyphicon-small glyphicon-euro"></i></td>
	<td> {{ round($line['IVA'],2) }} <i class="glyphicon-small glyphicon-euro"></i></td>
	<td> {{ round($line['TOTAL'],2) }} <i class="glyphicon-small glyphicon-euro"></i></td>
</td>
</tr> 

@endforeach

<table class="table table-hover">

<tr>
<th>Lineas eliminadas</th>
<th>Producto</th>
<th>Unidades</th>

</tr>

@foreach ($linesremoved as $line)

<tr>
	<td> {{ $line->NAME }} </td>
	<td> {{ $line->PRODUCTNAME }} </td>
	<td> {{ $line->UNITS }} </td>
</tr> 

@endforeach

</table>


<table class="table table-hover">

<tr>
<th>Nº Ticket</th>
<th>Fecha</th>
<th>Atendido por</th>
<th>Subtotal</th>
<th>IVA</th>
<th>Total</th>
<th></th>
</tr>

@for($i = 0; $i < sizeof($receipts_data); $i++)

<tr>
	<td> {{ $receipts_data[$i]['TICKETID'] }} </td>
	<td> {{ $receipts_data[$i]['DATE'] }} </td>
	<td> {{ $receipts_data[$i]['PERSON'] }} </td>
	<td> {{ round($receipts_data[$i]['SUBTOTAL'],2) }} <i class="glyphicon-small glyphicon-euro"></i></td>
	<td> {{ round($receipts_data[$i]['IVA'],2) }} <i class="glyphicon-small glyphicon-euro"></i></td>
	<td> {{ round($receipts_data[$i]['TOTAL'],2) }} <i class="glyphicon-small glyphicon-euro"></i></td>
	<td>
	<a href="/tickets/{{ $receipts_data[$i]['ID'] }}"><i class="glyphicon glyphicon-eye-open"></i></a>	
</td>
</tr> 
@endfor


</table>

@overwrite
