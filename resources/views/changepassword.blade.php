@extends('main')

@section('headers')

@overwrite
@section('head')
Cambiar contraseña
@overwrite
@section('content')
    
{!! Form::open(array('url' => 'changepassword', 'method' => 'post')) !!}
<div class="input-group">
    <span class="input-group-addon glyphicon glyphicon-lock"></span>
	<input type="password" class="form-control" placeholder="New password" name="password1" value="" size="2">
</div>
<div class="input-group">
    <span class="input-group-addon glyphicon glyphicon-lock"></span>
	<input type="password" placeholder="Repeat password" class="form-control" name="password2" id="data_two" value=""  size="2">
</div>
 	
    <!-- Buttons -->
    <button class="btn btn-default" type="submit"> Enviar
			    
  	</button>
</div>
{!! Form::close() !!} 

@overwrite