<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Floors;
use App\Places;
use App\People;
use App\Receipts;
use App\Taxes;
use App\DrawerOpened;
use App\LineRemoved;
use App\ClosedCash;
use Carbon\Carbon;
use PDF;

class ClosedCashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$closedcash = ClosedCash::all();
        //Y-m-d H:i:s
        if(\Input::get('date_one')) $date_one = Carbon::createFromFormat('d/m/Y H:i:s', \Input::get('date_one')." 00:00:00");
        else $date_one = Carbon::now()->subWeek();
        if(\Input::get('date_two')) $date_two = Carbon::createFromFormat('d/m/Y H:i:s', \Input::get('date_two')." 23:59:59");
        else $date_two = Carbon::now()->addDay();

        $closedcash = ClosedCash::where('DATEEND', '>', $date_one)
        ->where('DATEEND', '<=', $date_two)
        ->orderBy('DATEEND', 'desc')
        ->get();

        return view('closedcash', ['closedcashs' => $closedcash, 'date_one' => $date_one->format('d/m/Y'), 'date_two' => $date_two->format('d/m/Y')]);
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add($floor)
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
        $closedcash = ClosedCash::where('HOSTSEQUENCE', '=', $id)->first();

        $receipts = Receipts::where('DATENEW', '>', $closedcash->DATESTART)
        ->where('DATENEW', '<=', $closedcash->DATEEND)
        ->orderBy('DATENEW', 'desc')
        ->get();

        $closed_data['SUBTOTAL'] = 0;
        $closed_data['IVA'] = 0;
        $closed_data['TOTAL'] = 0;
        $people_data[] = NULL;
        $receipts_data[] = NULL;
        


        

        $taxtypes = Taxes::all();
        $people = People::all();

        $i = 0;

        foreach ($people as $person) {
            $person_data[$person->ID]['TOTAL'] = 0;
            $person_data[$person->ID]['NAME'] = $person->NAME;
            $person_data[$person->ID]['DRAWEROPENED'] = DrawerOpened::where('OPENDATE', '>', $closedcash->DATESTART)
        ->where('OPENDATE', '<=', $closedcash->DATEEND)->where('TICKETID', '=', 'No Sale')->where('NAME', 'LIKE', '%'.$person->NAME.'%')->count();$person_data[$person->ID]['LINEREMOVED'] = LineRemoved::where('REMOVEDDATE', '>', $closedcash->DATESTART)
        ->where('REMOVEDDATE', '<=', $closedcash->DATEEND)->where('NAME', 'LIKE', '%'.$person->NAME.'%')->count();          
        }

        $linesremoved = LineRemoved::where('REMOVEDDATE', '>', $closedcash->DATESTART)
        ->where('REMOVEDDATE', '<=', $closedcash->DATEEND)->get();         

        foreach ($receipts as $receipt) {

            $receipts_data[$i]['DATE'] = $receipt->DATENEW;
            $receipts_data[$i]['PERSON'] = $receipt->tickets->person->NAME;
            $receipts_data[$i]['TICKETID'] = $receipt->tickets->TICKETID;
            $receipts_data[$i]['ID'] = $receipt->tickets->ID;
            $receipts_data[$i]['SUBTOTAL'] = 0;
            $receipts_data[$i]['IVA'] = 0;
            $receipts_data[$i]['TOTAL'] = 0; 

            foreach ($receipt->ticketlines as $ticketline) {

                $receipts_data[$i]['SUBTOTAL'] += ($ticketline->UNITS * $ticketline->PRICE);
                $receipts_data[$i]['IVA'] += ($ticketline->UNITS * $ticketline->PRICE) * ($ticketline->tax->RATE);
                $receipts_data[$i]['TOTAL'] += ($ticketline->UNITS * $ticketline->PRICE) * ($ticketline->tax->RATE + 1); 
                if(isset($ticketline_data[$ticketline->PRODUCT])){

                    $ticketline_data[$ticketline->PRODUCT]['UNITS'] += $ticketline->UNITS;
                    $ticketline_data[$ticketline->PRODUCT]['SUBTOTAL'] += ($ticketline->UNITS * $ticketline->PRICE);
                    $ticketline_data[$ticketline->PRODUCT]['IVA'] += ($ticketline->UNITS * $ticketline->PRICE) * ($ticketline->tax->RATE);
                    $ticketline_data[$ticketline->PRODUCT]['TOTAL'] += ($ticketline->UNITS * $ticketline->PRICE) * ($ticketline->tax->RATE + 1); 


                } 
                else {

                    $ticketline_data[$ticketline->PRODUCT]['UNITS'] = $ticketline->UNITS;
                    $ticketline_data[$ticketline->PRODUCT]['NAME'] = $ticketline->products->NAME;
                    $ticketline_data[$ticketline->PRODUCT]['SUBTOTAL'] = ($ticketline->UNITS * $ticketline->PRICE);
                    $ticketline_data[$ticketline->PRODUCT]['IVA'] = ($ticketline->UNITS * $ticketline->PRICE) * ($ticketline->tax->RATE);
                    $ticketline_data[$ticketline->PRODUCT]['TOTAL'] = ($ticketline->UNITS * $ticketline->PRICE) * ($ticketline->tax->RATE + 1); 


                } 

            }

            $person_data[$receipt->tickets->PERSON]['TOTAL'] += $receipts_data[$i]['TOTAL'];
            $closed_data['SUBTOTAL'] += $receipts_data[$i]['SUBTOTAL'];
            $closed_data['IVA'] += $receipts_data[$i]['IVA'];
            $closed_data['TOTAL'] += $receipts_data[$i]['TOTAL'];
            $i++;
        }

        return view('closedcashdetail', ['closedcash' => $closedcash, 'taxtypes' => $taxtypes,'receipts' => $receipts, 'receipts_data' => $receipts_data, 'person_data' => $person_data, 'closed_data' => $closed_data, 'ticketline_data' => $ticketline_data, 'linesremoved' => $linesremoved]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detailpdf($id)
    {
        //
                //
        $closedcash = ClosedCash::where('HOSTSEQUENCE', '=', $id)->first();

        $receipts = Receipts::where('DATENEW', '>', $closedcash->DATESTART)
        ->where('DATENEW', '<=', $closedcash->DATEEND)
        ->orderBy('DATENEW', 'desc')
        ->get();

        $closed_data['SUBTOTAL'] = 0;
        $closed_data['IVA'] = 0;
        $closed_data['TOTAL'] = 0;
        $people_data[] = NULL;
        $receipts_data[] = NULL;

        

        $taxtypes = Taxes::all();
        $people = People::all();

        $i = 0;

        foreach ($people as $person) {
            $person_data[$person->ID]['TOTAL'] = 0;
            $person_data[$person->ID]['NAME'] = $person->NAME;
            $person_data[$person->ID]['DRAWEROPENED'] = DrawerOpened::where('OPENDATE', '>', $closedcash->DATESTART)
        ->where('OPENDATE', '<=', $closedcash->DATEEND)->where('TICKETID', '=', 'No Sale')->where('NAME', 'LIKE', '%'.$person->NAME.'%')->count();$person_data[$person->ID]['LINEREMOVED'] = LineRemoved::where('REMOVEDDATE', '>', $closedcash->DATESTART)
        ->where('REMOVEDDATE', '<=', $closedcash->DATEEND)->where('NAME', 'LIKE', '%'.$person->NAME.'%')->count();          
        }

        foreach ($receipts as $receipt) {

            $receipts_data[$i]['DATE'] = $receipt->DATENEW;
            $receipts_data[$i]['PERSON'] = $receipt->tickets->person->NAME;
            $receipts_data[$i]['TICKETID'] = $receipt->tickets->TICKETID;
            $receipts_data[$i]['ID'] = $receipt->tickets->ID;
            $receipts_data[$i]['SUBTOTAL'] = 0;
            $receipts_data[$i]['IVA'] = 0;
            $receipts_data[$i]['TOTAL'] = 0; 

            foreach ($receipt->ticketlines as $ticketline) {

                $receipts_data[$i]['SUBTOTAL'] += + ($ticketline->UNITS * $ticketline->PRICE);
                $receipts_data[$i]['IVA'] += ($ticketline->UNITS * $ticketline->PRICE) * ($ticketline->tax->RATE);
                $receipts_data[$i]['TOTAL'] += ($ticketline->UNITS * $ticketline->PRICE) * ($ticketline->tax->RATE + 1);   
            }
            $person_data[$receipt->tickets->PERSON]['TOTAL'] += $receipts_data[$i]['TOTAL'];
            $closed_data['SUBTOTAL'] += $receipts_data[$i]['SUBTOTAL'];
            $closed_data['IVA'] += $receipts_data[$i]['IVA'];
            $closed_data['TOTAL'] += $receipts_data[$i]['TOTAL'];
            $i++;
        }

        $view =  \View::make('closedcashdetailpdf', compact('closedcash', 'taxtypes', 'receipts', 'receipts_data', 'person_data', 'closed_data'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        
        return $pdf->stream('closedcash.pdf'); 

        /*return view('closedcashdetail', ['closedcash' => $closedcash, 'taxtypes' => $taxtypes,'receipts' => $receipts, 'receipts_data' => $receipts_data, 'person_data' => $person_data, 'closed_data' => $closed_data]);*/
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function select()
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
    public function update(Request $request)
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
