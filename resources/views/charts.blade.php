@extends('main')

@section('headers')

<script src='{{ url('/') }}/statics/plugins/chartjs/Chart.min.js'></script>

@overwrite
@section('head')
Graficos
@overwrite
@section('content')

<div class="row row-centered">

	<div class="col-md-12 col-xs-12 col-centered">
	<h3>Not available</h3>

</div>
  <!-- DONUT CHART 
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

                </div><!-- /.box-body 
              </div><!-- /.box 

	</div>
  <!-- DONUT CHART 
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
                    <canvas id="pieChart" style="height:250px"></canvas>

                </div><!-- /.box-body 
              </div><!-- /.box 
	</div>

	-->
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
	{
		value: 20,
		color:"#878BB6",
		label: "Red"
	},
	{
		value : 80,
		color : "#4ACAB4",
		label: "Red"
	},
	{
		value : 10,
		color : "#FF8153",
		label: "Red"
	},
	{
		value : 30,
		color : "#FFEA88",
		label: "Red"
	}
];

var pieOptions = {
	segmentShowStroke : false,
	animateScale : true
}
new Chart(countries).Doughnut(pieData,pieOptions);
//new Chart(countries).Pie(pieData, pieOptions);

</script>


    
@overwrite