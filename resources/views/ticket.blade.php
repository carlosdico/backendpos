@extends('main')

@section('headers')

	<link href="statics/css/smoothness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" type="text/css" />
	<script src="statics/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="statics/development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="statics/development-bundle/ui/jquery.ui.datepicker.js"></script>
	

@overwrite


@section('content')
    

<table class="table table-hover">
<tr>
<th>PRODUCTO</th>
<th>UNIDADES</th>
<th>PRECIO</th>
<th>TIPO IVA</th>
<th>TOTAL</th>
<th></th>

</tr>

{{--*/ $total = 0 /*--}}

@foreach ($ticket_data->ticketlines as $ticketline)

<tr>
<td>{{ $ticketline->product->NAME }} </td>
<td>{{ $ticketline->UNITS }} </td>
<td>{{ round($ticketline->PRICE, 2) }} </td>
<td>{{ $ticketline->tax->RATE * 100 }} % </td>
<td>{{ ($ticketline->UNITS * $ticketline->PRICE) * ($ticketline->tax->RATE + 1) }} <i class="glyphicon-small glyphicon-euro"></td>

{{--*/ $total = $total + ($ticketline->UNITS * $ticketline->PRICE) * ($ticketline->tax->RATE + 1) /*--}}


</tr>


@endforeach

<tr>
<td></td>
<td></td>
<td></td>
<td>TOTAL</td>
<td>{{ $total  }} <i class="glyphicon-small glyphicon-euro"></td>

</tr>


</table>

@overwrite
