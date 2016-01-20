<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tickets;
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
        //
        if(\Input::get('date_one')) $date_one = Carbon::createFromFormat('d/m/Y', \Input::get('date_one'));
        else $date_one = Carbon::now()->subWeek();
        if(\Input::get('date_two')) $date_two = Carbon::createFromFormat('d/m/Y', \Input::get('date_two'));
        else $date_two = Carbon::now();

        $i = 0;

        $receipts = Receipts::where('DATENEW', '>', $date_one)
        ->where('DATENEW', '<=', $date_two)
        ->get();

        //$receipts = Receipts::all();

        $tickets_data[] = NULL;

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
                $tickets_data[$i]['PRICE'] = $tickets_data[$i]['PRICE'] + $ticketline->product->PRICESELL;
            }

            $tickets_data[$i]['PRICE'] =  round($tickets_data[$i]['PRICE'], 2);
            $i++;
        }

        return view('tickets', ['tickets_data' => $tickets_data, 'date_one' => $date_one->format('d/m/Y'), 'date_two' => $date_two->format('d/m/Y')]);
    }

    public function invoice() 
    {
        $data = $this->getData();
        $date = date('Y-m-d');
        $invoice = "2222";
        $view =  \View::make('ticketslist', compact('data', 'date', 'invoice'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice');
    }
 
    public function getData() 
    {
        $data =  [
            'quantity'      => '1' ,
            'description'   => 'some ramdom text',
            'price'   => '500',
            'total'     => '500'
        ];
        return $data;
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
