<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Floors;
use App\Places;

class FloorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
       $price = \DB::select( \DB::raw("SELECT MAX(CONVERT(ID, UNSIGNED INTEGER)) AS MAXID FROM PLACES"));

       $new_table_id = $price[0]->MAXID + 1;
       //var_dump($price);

       $place = new Places;
       $place->ID = $new_table_id;
       $place->NAME = 'Table '.$new_table_id;
       $place->X = 40;
       $place->Y = 40;
       $place->FLOOR = $floor;

       $place->save();

        return redirect()->route('showallfloors');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
        if(\Input::get('floor')) echo \Input::get('floor');
        if(\Input::get('floor')) $floor = Floors::find(\Input::get('floor'));
        else $floor = Floors::first();
        # code...

        $image = $floor->IMAGE;

        $myfile = fopen("image", "w+") or die("Unable to open file!");
        fwrite($myfile, $image);
        fclose($myfile);
        list($ancho, $alto, $tipo, $atributos) = getimagesize("image");
        $type = exif_imagetype("image");

        $places = Places::where('FLOOR', '=', $floor->ID)->get();

        $floors = Floors::all();

        return view('floors', ['floors' => $floors, 'floor_selected' => $floor->ID, 'places' => $places, 'type' => $type, 'ancho' => $ancho, 'alto' => $alto]);

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
    public function update(Request $request)
    {
        //

        for($i=0; $i<=\Input::get('elements'); $i++){

           $place = Places::find(\Input::get($i.'id'));

           $place->X = \Input::get($i.'x');
           $place->Y = \Input::get($i.'y');

           $place->save();

        }

        return \Redirect::to('floors')->with('floor', $place->FLOOR);
        //return redirect()->route('showallfloors');

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
