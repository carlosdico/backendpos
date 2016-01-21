@extends('main')

@section('headers')

@overwrite
@section('head')
Categorias
@overwrite
@section('content')
    

<table class="table table-hover">
<tr>
<th>CATEGORIA</th>
<th>PADRE</th>
</tr>

@foreach ($categories as $category)

<tr>
<td>{{ $category->NAME }} </td>
<td>
@if($category->PARENTID != NULL)
	{{ $category->parent->NAME }} 
@endif
</td>
</tr>

@endforeach

</table>

@overwrite
