<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Payments;
use App\Receipts;
use Carbon\Carbon;


class ChartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
        //$products = 0;
/*
        $date_one = Carbon::now()->subWeek();
        $date_two = Carbon::now();
*/

        $receipts = Receipts::where('DATENEW', '>', Carbon::now()->subMonth())
        ->where('DATENEW', '<=', Carbon::now())
        ->orderBy('DATENEW', 'desc')
        ->get();

        $products_mes = array();

        foreach ($receipts as $receipt) {

            $base = 0;
            $total = 0;

            foreach ($receipt->ticketlines as $ticketline) {

                $name = $ticketline->product->NAME;
                $units = $ticketline->UNITS;

                if(isset($products_mes[$name])){

                    $products_mes[$name]['units'] += $units;
                    
                }
                else {

                    $products_mes[$name]['units'] = $units;
                    $products_mes[$name]['name'] = $name;
                    $products_mes[$name]['color'] = self::random_color();

                }

            }
        }

        $receipts = Receipts::where('DATENEW', '>', Carbon::now()->subWeek())
        ->where('DATENEW', '<=', Carbon::now())
        ->orderBy('DATENEW', 'desc')
        ->get();

        $products_semana = array();

        foreach ($receipts as $receipt) {

            $base = 0;
            $total = 0;



            foreach ($receipt->ticketlines as $ticketline) {

                $name = $ticketline->product->NAME;
                $units = $ticketline->UNITS;

                if(isset($products_semana[$name])){

                    $products_semana[$name]['units'] += $units;
                    
                }
                else {

                    $products_semana[$name]['units'] = $units;
                    $products_semana[$name]['name'] = $name;
                    $products_semana[$name]['color'] = self::random_color();


                }

            }
        }



        return view('charts', ['products_semana' => $products_semana, 'products_mes' => $products_mes]);

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

    function random_color_part() {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }

    function random_color() {
        return '#' . self::random_color_part() . self::random_color_part() . self::random_color_part();
    }

}


