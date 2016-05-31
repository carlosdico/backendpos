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
    
<table class="table table-hover">
<tr>
<th>TICKET</th>
<th>DATE<br>
	<div class="input-group input-group-sm">

	</div>
	{!! Form::open(array('url' => 'tickets', 'method' => 'post')) !!}
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
</th>
<th>CUSTOMER</th>
<th>TOTAL</th>
<th>
{!! Form::open(array('url' => 'pdf', 'method' => 'post', 'target' => '_blank')) !!}
		<input type="hidden" class="form-control" name="date_one" id="data_one" value="{{ $date_one }}" size="1">
		<input type="hidden" class="form-control" name="date_two" id="data_two" value="{{ $date_two }}" size="1">
		
		<button type="submit" class="btn">
               <i class="fa fa-file-pdf-o"></i>

        </button>

{!! Form::close() !!} 
</th>

</tr>

@foreach ($receipts as $receipt)

{{--*/ $base = 0 /*--}}
{{--*/ $total = 0 /*--}}

@foreach ($taxtypes as $taxtype)

{{--*/ $IVA[$taxtype->ID] = 0 /*--}}

@endforeach 
           
<tr>
<td bgcolor="#cdcdcd"><strong> {{ $receipt->tickets->TICKETID }} </strong></td>
<td bgcolor="#cdcdcd"><strong> 

	{{ date('d-m-Y H:m:s', strtotime($receipt->DATENEW)) }} - {{ $receipt->tickets->person->NAME }}

</strong></td>
<td bgcolor="#cdcdcd"><strong> {{ $receipt->CUSTOMER }} </strong></td>
<td bgcolor="#cdcdcd"> </td>
<td bgcolor="#cdcdcd"><a href="/tickets/{{ $receipt->tickets->ID }}"><i class="glyphicon glyphicon-eye-open"></i></a></td>

</tr>

@foreach ($receipt->ticketlines as $ticketline)

<tr>
<td></td>
<td colspan="2">{{ $ticketline->products->NAME }} </td>

<td>{{ round($ticketline->PRICE * ($ticketline->tax->RATE + 1), 2) }} x {{ $ticketline->UNITS }} uds </td>

<td>{{ ($ticketline->UNITS * $ticketline->PRICE) * ($ticketline->tax->RATE + 1) }} <i class="glyphicon-small glyphicon-euro"></td>

{{--*/ $IVA[$ticketline->tax->ID] += ($ticketline->UNITS * $ticketline->PRICE) * ($ticketline->tax->RATE)  /*--}}
{{--*/ $base = $base + ($ticketline->UNITS * $ticketline->PRICE) /*--}}
{{--*/ $total = $total + ($ticketline->UNITS * $ticketline->PRICE) * ($ticketline->tax->RATE + 1) /*--}}


</tr>

@endforeach


<tr>
<td></td>
<td></td>
<td></td>
<td>BASE </td>

<td>{{ round($base, 2) }} <i class="glyphicon-small glyphicon-euro"></i></td>

</tr>

@foreach ($taxtypes as $taxtype)

@if($IVA[$taxtype->ID] != 0)

<tr>
<td></td>
<td></td>
<td></td>
<td>IVA {{ $taxtype->RATE * 100 }} % </td>

<td>{{ round($IVA[$taxtype->ID], 2) }} <i class="glyphicon-small glyphicon-euro"></i></td>

</tr>

@endif

@endforeach 


<tr>

<td></td>
<td></td>
<td></td>
<td>TOTAL</td>


<td>{{ $total }} <i class="glyphicon-small glyphicon-euro"></i></td>

</tr>

@endforeach



</table>

@overwrite
