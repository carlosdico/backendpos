@extends('main')

@section('headers')

<script src='{{ url('/') }}/statics/plugins/chartjs/Chart.min.js'></script>

@overwrite
@section('head')
Graficos
@overwrite
@section('content')
<!--
   <div class="col-md-6">
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Donut Chart</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                    <canvas id="pieChart2" style="height:250px"></canvas>

                </div> 
              </div> 

	</div>
-->


  <div class="col-md-6">
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Top productos Semana</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                    <canvas id="pieChart" style="height:250px"></canvas>

                </div>  
              </div> 
	</div>

  <div class="col-md-6">
              <div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">Top productos Mes</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                    <canvas id="pieChart1" style="height:250px"></canvas>

                </div>  
              </div> 
	</div>


</div>



<script>
    var buyers = document.getElementById('pieChart2').getContext('2d');
var buyerData = {
	labels : ["January","February","March","April","May","June"],
	datasets : [
		{
			fillColor : "rgba(172,194,132,0.4)",
			strokeColor : "#ACC26D",
			pointColor : "#fff",
			pointStrokeColor : "#9DB86D",
			data : [203,156,99,251,305,247]
		}
	]
}
new Chart(buyers).Line(buyerData);
</script>

<script>
var countries= document.getElementById("pieChart").getContext("2d");

var pieData = [

	@foreach ($products_semana as $product)
	{
		value: {{ $product['units'] }},
		color: "{{$product['color'] }}",
		label: "{{ $product['name'] }}"
	},

	@endforeach
	
];

var pieOptions = {
	segmentShowStroke : false,
	animateScale : true
}
new Chart(countries).Doughnut(pieData,pieOptions);
//new Chart(countries).Pie(pieData, pieOptions);

</script>

<script>
var countries= document.getElementById("pieChart1").getContext("2d");

var pieData = [

	@foreach ($products_mes as $product)
	{
		value: {{ $product['units'] }},
		color: "{{$product['color'] }}",
		label: "{{ $product['name'] }}"
	},

	@endforeach
	
];

var pieOptions = {
	segmentShowStroke : false,
	animateScale : true
}
new Chart(countries).Doughnut(pieData,pieOptions);
//new Chart(countries).Pie(pieData, pieOptions);

</script>
    
@overwrite