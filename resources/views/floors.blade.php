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

@foreach ($places as $place)

<script type="text/javascript">
addRect('{{ $place->X }}', '{{ $place->Y }}', 130, 100, "#00FFFF");
</script>'

@endforeach

  echo '<p class="text-left">'.$row['NAME'].'
    <input type="text" name="'.$i.'x" id="'.$i.'x" value="'.$row['X'].'" size="2" >
    <input type="text" name="'.$i.'y" id="'.$i.'y" value="'.$row['Y'].'" size="2">
    <input type="hidden" name="'.$i.'id" id="'.$i.'y" value="'.$row['ID'].'" size="2">

    </p>';
    $i++;
}
$i--;
echo '<input type="hidden" name="elements" value="'.$i.'">';
echo '<input type="hidden" name="floor" value="'.$floor.'">';



<input type="submit" value="Save">
</form>
</div>
</div>

<script>


</script>

	<script type="text/javascript">
		window.onload=init();
	</script>

@overwrite
