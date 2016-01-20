<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Unnopos-Listado</title>
    
  </head>
  <body>
 
    <main>
      <div id="details" class="clearfix">
        <div id="invoice">
          <div class="date">
                <img src="{{ url('/') }}/logo_negro.png" width="300" alt="User Image">
          </div>
          <h3>Listado de facturas desde {{ $date_one->format('d/m/Y') }} al {{ $date_two->format('d/m/Y') }}</h3>
         
        </div>
      </div>


      <table class="table table-hover" width="100%" border="1" border-spacing="0">
      <tr>
      <th>TICKET</th>
      <th>FECHA</th>
      <th>CLIENTE</th>
      <th>TOTAL</th>

      </tr>

      @for($i = 0; $i < sizeof($tickets_data); $i++)

      <tr>
      <td align="center">{{ $tickets_data[$i]['TICKETID'] }} </td>
      <td align="center">{{ $tickets_data[$i]['DATE'] }} </td>
      <td align="center">{{ $tickets_data[$i]['CUSTOMER'] }} </td>
      <td align="center">{{ $tickets_data[$i]['PRICE'] }} €</i></td>

      </tr>

      @endfor

      </table>



  </body>
</html>