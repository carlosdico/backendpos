<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tickets;
use App\Taxes;
use App\Ticketlines;
use App\Receipts;
use Carbon\Carbon;
use PDF;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Y-m-d H:i:s
        if(\Input::get('date_one')) $date_one = Carbon::createFromFormat('d/m/Y H:i:s', \Input::get('date_one')." 00:00:00");
        else $date_one = Carbon::now()->subWeek();
        if(\Input::get('date_two')) $date_two = Carbon::createFromFormat('d/m/Y H:i:s', \Input::get('date_two')." 23:59:59");
        else $date_two = Carbon::now()->addDay();

        $i = 0;

        $receipts = Receipts::where('DATENEW', '>', $date_one)
        ->where('DATENEW', '<=', $date_two)
        ->orderBy('DATENEW', 'desc')
        ->get();

        $taxtypes = Taxes::all();

        return view('tickets', ['taxtypes' => $taxtypes,'receipts' => $receipts, 'date_one' => $date_one->format('d/m/Y'), 'date_two' => $date_two->format('d/m/Y')]);
    }

    public function ticketspdf() 
    {

        if(\Input::get('date_one')) $date_one = Carbon::createFromFormat('d/m/Y H:i:s', \Input::get('date_one')." 00:00:00");
        else $date_one = Carbon::now()->subWeek();
        if(\Input::get('date_two')) $date_two = Carbon::createFromFormat('d/m/Y H:i:s', \Input::get('date_two')." 23:59:59");
        else $date_two = Carbon::now();

        $receipts = Receipts::where('DATENEW', '>', $date_one)
        ->where('DATENEW', '<=', $date_two)
        ->orderBy('DATENEW', 'desc')
        ->get();

        $tickets_data[] = NULL;
        $i = 0;

        foreach ($receipts as $receipt) {
            
            $date = Carbon::createFromFormat('Y-m-d H:i:s', $receipt->DATENEW);
            $date = $date->format('d-m-Y H:i:s');
            $tickets_data[$i]['ID'] = $receipt->tickets->ID;
            $tickets_data[$i]['TICKETID'] = $receipt->tickets->TICKETID;
            $tickets_data[$i]['DATE'] = $date;
            $tickets_data[$i]['PRICE'] = 0;
            $tickets_data[$i]['CUSTOMER'] = $receipt->CUSTOMER;

            $ticketlines = Ticketlines::where('TICKET', '=', $receipt->ID)->get();

            foreach ($ticketlines as $ticketline) {
                $tickets_data[$i]['PRICE'] = $tickets_data[$i]['PRICE'] + $ticketline->products->PRICESELL;
            }

            $tickets_data[$i]['PRICE'] =  round($tickets_data[$i]['PRICE'], 2);
            $i++;
        }

        $date = date('Y-m-d');
        $view =  \View::make('ticketslist', compact('tickets_data', 'date_one', 'date_two'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        
        return $pdf->stream('tickets.pdf');
    
    } 


    public function ticketpdf($receipt)
    {

        /*if(\Input::get('date_one')) $date_one = Carbon::createFromFormat('d/m/Y H:i:s', \Input::get('date_one')." 00:00:00");
        else $date_one = Carbon::now()->subWeek();
        if(\Input::get('date_two')) $date_two = Carbon::createFromFormat('d/m/Y H:i:s', \Input::get('date_two')." 23:59:59");
        else $date_two = Carbon::now();
*/
        $receipt = Receipts::find($receipt);

        $tickets_data[] = NULL;
        $i=0;
        $date = Carbon::createFromFormat('Y-m-d H:i:s', $receipt->DATENEW);
        $date = $date->format('d-m-Y H:i:s');
        $tickets_data['ID'] = $receipt->tickets->ID;
        $tickets_data['TICKETID'] = $receipt->tickets->TICKETID;
        $tickets_data['DATE'] = $date;
        $tickets_data['PRICE'] = 0;
        $tickets_data['CUSTOMER'] = $receipt->CUSTOMER;

        $ticketlines = Ticketlines::where('TICKET', '=', $receipt->ID)->get();

        $PRICE = 0;
        foreach ($ticketlines as $ticketline) {
            $PRICE = $PRICE + $ticketline->products->PRICESELL;
        }

        $PRICE =  round($PRICE, 2);

        echo $PRICE;

/*
        $date = date('Y-m-d');
        $view =  \View::make('ticket', compact('tickets_data', 'date_one', 'date_two'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        
        return $pdf->stream('tickets.pdf');
    */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $receipt = Receipts::find($id);
        return view('ticket', ['ticket_data' => $receipt]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
