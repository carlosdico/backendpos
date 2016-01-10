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
<th>TICKET</th>
<th>DATE</th>
<th>CUSTOMER</th>
<th>TOTAL</th>
<th></th>

</tr>

<tr>
<td>{{ $ticket_data->TICKETID }} </td>
<td>{{ $ticket_data->DATE }} </td>
<td>{{ $ticket_data->CUSTOMER }} </td>
<td>{{ $ticket_data->PRICE }} <i class="glyphicon-small glyphicon-euro"></i></td>

</tr>

@foreach ($ticket_data->ticketlines as $ticketline)

<tr>
<td>{{ $ticketline->product->NAME }} </td>
<td>{{ $ticketline->UNITS }} </td>
<td>{{ $ticketline->PRICE }} </td>
<td>{{ $ticketline->tax->RATE * 100 }} % </td>
<td>{{ ($ticketline->UNITS * $ticketline->PRICE) * ($ticketline->tax->RATE + 1) }} <i class="glyphicon-small glyphicon-euro"></td>

</tr>


@endforeach


</table>

{{ var_dump($ticket_data) }}

@overwrite
