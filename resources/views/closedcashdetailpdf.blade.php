<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Unnopos-Listado</title>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Ubuntu" />
<style>

  body {
    font-family: Ubuntu;
    font-size: 12px;
    font-style: normal;
    font-variant: normal;
  }
  h1 {
    font-family: Ubuntu;
    font-size: 24px;
    font-style: normal;
    font-variant: normal;
    font-weight: 500;
    line-height: 26.4px;
  }
  h3 {
    font-family: Ubuntu;
    font-size: 14px;
    font-style: normal;
    font-variant: normal;
    font-weight: 500;
    line-height: 15.4px;
  }
  p {
    font-family: Ubuntu;
    font-size: 14px;
    font-style: normal;
    font-variant: normal;
    font-weight: 400;
    line-height: 20px;
  }
  blockquote {
    font-family: Ubuntu;
    font-size: 21px;
    font-style: normal;
    font-variant: normal;
    font-weight: 400;
    line-height: 30px;
  }
  pre {
    font-family: Ubuntu;
    font-size: 13px;
    font-style: normal;
    font-variant: normal;
    font-weight: 400;
    line-height: 18.5667px;
  }

  .red {
    background-color: #ff0030;
    font-family: Ubuntu;
    font-size: 14px;
    font-style: normal;
    font-variant: normal;
    font-weight: 400;
    color: #ffffff;
    line-height: 10px;
    padding: 5px, 5px, 5px;
    margin: 5px, 0px, 5px;

  }

  .rTable {
        display: table;
        width: 100%;
        margin-bottom: 10px;

  }
  .rTableRow {
        display: table-row;
  }
  .rTableHeading {
        display: table-header-group;
        background-color: #ddd;
  }
  .rTableCell, .rTableHead {
        display: table-cell;
        padding: 3px 10px;
        border: 1px solid #999999;
  }
  .rTableHeading {
        display: table-header-group;
        background-color: #ddd;
        font-weight: bold;
  }
  .rTableFoot {
        display: table-footer-group;
        font-weight: bold;
        background-color: #ddd;
  }
  .rTableBody {
        display: table-row-group;
  }

</style>

<div id="details" class="clearfix">
<div id="invoice">
  <div class="date">
        <img src="{{ url('/') }}/logo_negro.png" width="150" alt="Company logo">
  </div>
  <div class="red">
  Cierre de caja {{ $closedcash->HOSTSEQUENCE }} / {{ date('d-m-Y H:m:s', strtotime($closedcash->DATESTART)) }} - {{ date('d-m-Y H:m:s', strtotime($closedcash->DATEEND)) }}</div>
</div>
</div>

<div class="rTable">
 <div class="rTableRow">
 <div class="rTableHead"><strong>Subtotal</strong></div>
 <div class="rTableHead"><strong>IVA</strong></div>
 <div class="rTableHead"><strong>Total</strong></div>
 </div>
   <div class="rTableRow">
   <div class="rTableCell">{{ round($closed_data['SUBTOTAL'],2) }} €</div>
   <div class="rTableCell">{{ round($closed_data['IVA'],2) }} €</div>
   <div class="rTableCell">{{ round($closed_data['TOTAL'],2) }} €</div>
   </div>
</div>

<div class="rTable">
 <div class="rTableRow">
 <div class="rTableHead"><strong>Usuario</strong></div>
 <div class="rTableHead"><strong>Total</strong></div>
 <div class="rTableHead"><strong>Apertura de cajon</strong></div>
 <div class="rTableHead"><strong>Líneas eliminadas</strong></div>
 </div>

@foreach ($person_data as $person)
   <div class="rTableRow">
   <div class="rTableCell">{{ $person['NAME'] }}</div>
   <div class="rTableCell">{{ $person['TOTAL'] }} €</div>
   <div class="rTableCell">{{ $person['DRAWEROPENED'] }}</div>
   <div class="rTableCell">{{ $person['LINEREMOVED'] }}</div>
   </div>
@endforeach
</div>

<div class="rTable">
 <div class="rTableRow">
 <div class="rTableHead"><strong>Ticket</strong></div>
 <div class="rTableHead"><strong>Fecha</strong></div>
 <div class="rTableHead"><strong>Usuario</strong></div>
 <div class="rTableHead"><strong>Subtotal</strong></div>
 <div class="rTableHead"><strong>IVA</strong></div>
 <div class="rTableHead"><strong>Total</strong></div>
 </div>

@for($i = 0; $i < sizeof($receipts_data); $i++)
   <div class="rTableRow">
   <div class="rTableCell">{{ $receipts_data[$i]['TICKETID'] }}</div>
   <div class="rTableCell">{{ $receipts_data[$i]['DATE'] }}</div>
   <div class="rTableCell">{{ $receipts_data[$i]['PERSON'] }}</div>
   <div class="rTableCell">{{ round($receipts_data[$i]['SUBTOTAL'],2) }} €</div>
   <div class="rTableCell">{{ round($receipts_data[$i]['IVA'],2) }} €</div>
   <div class="rTableCell">{{ round($receipts_data[$i]['TOTAL'],2) }} €</div>
   </div>
@endfor
   <div class="rTableRow">
   <div class="rTableCell"></div>
   <div class="rTableCell"></div>
   <div class="rTableCell">Totales: </div>
   <div class="rTableCell">{{ round($closed_data['SUBTOTAL'],2) }} €</div>
   <div class="rTableCell">{{ round($closed_data['IVA'],2) }} €</div>
   <div class="rTableCell">{{ round($closed_data['TOTAL'],2) }} €</div>
   </div>
</div>