@extends('main')

@section('headers')

	<link href="statics/css/smoothness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" type="text/css" />
	<script src="statics/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="statics/development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="statics/development-bundle/ui/jquery.ui.datepicker.js"></script>
	
@overwrite

@section('content')

<table class="table table-hover" width="200px">
<tr>
<td>Ticket:</td>
<td>{{ $ticket_data->tickets->TICKETID }}</td>
</tr>
<tr>
<td>Fecha:</td>
<td>{{ date('d-m-Y H:m:s', strtotime($ticket_data->DATENEW)) }}</td>
</tr>
<tr>
<td>Terminal:</td>
<td>{{ $ticket_data->closedcash->HOST }}</td>
</tr>
<tr>
<td>Le atendió:</td>
<td>{{ $ticket_data->tickets->person->NAME }}</td>
</tr>

</table>

<table class="table table-hover" width="200px">
<tr with="200px">
<th>Articulos</th>
<th>Precio</th>
<th>Uds.</th>
<th>Total</th>
<th></th>

</tr>

{{--*/ $total = 0 /*--}}
{{--*/ $subtotal = 0 /*--}}
{{--*/ $articulos = 0 /*--}}

@foreach ($ticket_data->ticketlines as $ticketline)

<tr>
<td>{{ $ticketline->products->NAME }} </td>
<td>{{ round($ticketline->PRICE, 2) }} <i class="glyphicon-small glyphicon-euro"></td>
<td>x{{ $ticketline->UNITS }} </td>
<!--{{ $ticketline->tax->RATE * 100 }} % </td> -->
{{--*/ $subtotal = $subtotal + ($ticketline->UNITS * $ticketline->PRICE) /*--}}
<td>{{ ($ticketline->UNITS * $ticketline->PRICE) * ($ticketline->tax->RATE + 1) }} <i class="glyphicon-small glyphicon-euro"></td>

{{--*/ $total = $total + ($ticketline->UNITS * $ticketline->PRICE) * ($ticketline->tax->RATE + 1) /*--}}

</tr>

{{--*/ $articulos++ /*--}}

@endforeach

</table>

<table class="table table-hover" width="200px">
<tr>
<td>Articulos: {{ $articulos }}</td>
</tr>
<tr>
<td><strong>Total: </td>
<td><strong>{{ $total  }} <i class="glyphicon-small glyphicon-euro"></td>
</tr>

@if($ticket_data->payments->PAYMENT == 'cash')
<tr>
<td>Efectivo </td>
<td>{{ $ticket_data->payments->TENDERED }} <i class="glyphicon-small glyphicon-euro"></td>
</tr>
<tr>
<td>Devuelto </td>
<td>{{ $ticket_data->payments->TENDERED - $total }} <i class="glyphicon-small glyphicon-euro"></td>
</tr>
@else
<tr>
<td>{{ $ticket_data->payments->PAYMENT }} </td>
<td></td>
</tr>
@endif

<tr>
<td>Subtotal: </td>
<td>{{ round($subtotal, 2)  }} <i class="glyphicon-small glyphicon-euro"></td>
</tr>
<tr>
<td>IVA: </td>
<td>{{ round($total - $subtotal, 2)  }} <i class="glyphicon-small glyphicon-euro"></td>
</tr>
</table>

@overwrite
