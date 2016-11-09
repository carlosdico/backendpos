
<html>
    <head>
        <title>Unnopos Managment</title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="{{ url('/') }}/statics/bootstrap-3.3.5-dist/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="{{ url('/') }}/statics/bootstrap-3.3.5-dist/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->

<script src="{{ url('/') }}/statics/js/jquery-2.1.4.min.js"></script>

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
          padding-top: 10px;
    		  width: 100%;
    		  /* Set the fixed height of the footer here */
    		  height: 40px;
          font-size: 12px;
    		  background-color: #000000;
          color: #FFFFFF;

    		}
        a:link {
          color: #FFFFFF;
        }

        /* unvisited link */
        a:visited {
          color: #FFFFFF;
        }

        a:hover {
          color: #FFFFFF;
          text-decoration: none;
        }

        </style> 

		@yield('headers')

    </head>
    <body>

    <div class="container">

    	<div class="container">
            @yield('content')
        </div>

    </div><!--/.container-->


    <div class="container footer">

      <p>&copy; <a href="http://www.websistems.com">Websistems S.L.U </a> {{{ date('Y') }}} </p>

    </div><!--/.container-->

    </body>
</html>

<script src="{{ url('/') }}/statics/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>


