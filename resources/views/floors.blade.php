@extends('master')

@section('headers')

    <style type="text/css">
      #container { position: relative; }
      #canvas { border: 1px solid #000; 
        background-image: url('image');
      }
    </style>
	<script type="text/javascript" src="statics/js/boxes.js"></script>


@overwrite

@section('content')
    
<div class="row"> 
<div class="col-md-10">
  <canvas id="canvas" width="{{ $ancho }}" height="{{ $alto }}"></canvas>
</div>

<div class="col-md-2">

{!! Form::open(array('url' => 'floors', 'method' => 'post')) !!}

<select name="floor" onchange="this.form.submit()">

@foreach ($floors as $floor)

  <option name="floor" value="{{ $floor->ID }}"
  	@if ($floor->ID === $floor_selected) 
  		selected 
  	@endif
  > {{ $floor->NAME }} 
  	
  </option>

@endforeach

</select>

{!! Form::close() !!}

<p>
<a href="/addtable/{{ $floor_selected }}" class="btn btn-default btn-sm active" role="button">Add table</a>
</p>

{!! Form::open(array('url' => 'savefloors', 'method' => 'post')) !!}

<?php $i = 0; ?>  
@foreach ($places as $place)

<script type="text/javascript">
addRect('{{ $place->X }}', '{{ $place->Y }}', 130, 100, "#00FFFF");
</script>

    <p class="text-left">{{ $place->NAME }}
    <input type="text" name="{{ $i }}x" id="{{ $i }}x" value="{{ $place->X }}" size="2" >
    <input type="text" name="{{ $i }}y" id="{{ $i }}y" value="{{ $place->Y }}" size="2">
    <input type="hidden" name="{{ $i }}id" id="{{ $i }}y" value="{{ $place->ID }}" size="2">
    <input type="hidden" name="elements" value="{{ $i }}">
   
<?php $i++; ?>

@endforeach

<input type="hidden" name="floor" value="{{ $place->FLOOR }}">
<input type="submit" name="submit" value="Save">

{!! Form::close() !!}

</div>
</div>

<script>


</script>

	<script type="text/javascript">
		window.onload=init();
	</script>

@overwrite
