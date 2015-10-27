
<html>
    <head>
        <title>BackendPOS by Vanian Technology</title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="/statics/bootstrap-3.3.5-dist/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="/statics/bootstrap-3.3.5-dist/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="/statics/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
<script src="/statics/js/jquery-2.1.4.min.js"></script>


        <style>

        body {
		  /* Margin bottom by footer height */
		  margin-bottom: 60px;
		  margin-top: 60px;
		  height: 250px;

		}

		.footer {
		  position: absolute;
		  bottom: 0;
		  width: 100%;
		  /* Set the fixed height of the footer here */
		  height: 30px;
		  background-color: #f5f5f5;
		}

        </style> 

        <script>
			  $(function() {
			    $( "#datepicker" ).datepicker();
			  });
  		</script>


		@yield('headers')


    </head>
    <body>

    <nav class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Backend POS</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="tickets">Tickets</a></li>
            <li><a href="floors">Floors</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar -->

    <div class="container">

    	<div class="container">
            @yield('content')
        </div>



    <div class="footer">

        <p>&copy; <a href="http://www.vaniantechnology.com">Vanian Technology</a> 2015 </p>

    </div>

    </div><!--/.container-->
    </body>
</html>

	<script type="text/javascript">
function func1() {
  alert("This is the first.");
}
window.onload=init();
	</script>