@extends('main')

@section('headers')

@overwrite

@section('head')
Producto
@overwrite

@section('content')
    

<table class="table table-hover">
<tr>
<th>NOMBRE</th>
<th>REFERENCIA</th>
<th>CODIGO</th>
<th>PRECIO COMPRA</th>
<th>PRECIO 1</th>
<th>PRECIO 2</th>
<th>PRECIO 3</th>
<th>IVA</th>
<th>CATEGORIA</th>
</tr>

  <!--
	protected $fillable = ['ID', 'REFERENCE', 'CODE', 
	'CODETYPE', 'NAME', 'PRICEBUY', 'PRICESELL', 
	'PRICESELL1', 'PRICESELL2', 'CATEGORY', 'TAXCAT',
	 'ATTRIBUTESET_ID', 'STOCKCOST', 'STOCKVOLUME', 
	 'IMAGE', 'ISCOM', 'ISSCALE', 'ISKITCHEN', 'PRINTKB', 'SENDSTATUS', 'ISSERVICE', 'ATTRIBUTES', 'DISPLAY', 'ISVPRICE', 'ISVERPATRIB', 'TEXTTIP', 'WARRANTY', 'STOCKUNITS'];
-->
<tr>
<td>{{ $product->NAME }} </td>
<td>{{ $product->REFERENCE }} </td>
<td>{{ $product->CODE }} </td>
<td>{{ $product->PRICEBUY }} </td>
<td>{{ $product->PRICESELL * $product->Taxes->RATE + $product->PRICESELL }} </td>
<td>{{ $product->PRICESELL1 * $product->Taxes->RATE + $product->PRICESELL1 }} </td>
<td>{{ $product->PRICESELL2 * $product->Taxes->RATE + $product->PRICESELL2 }} </td>
<td>{{ $product->Taxes->RATE * 100 }} % </td>
<td>{{ $product->Category->NAME }} </td>
<td><a href="/product/{{ $product->ID }}"><i class="fa fa-edit"></i></td>


</tr>


</table>

@overwrite