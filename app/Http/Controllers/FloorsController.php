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
        if(\Input::get('floor')) $floor = Floors::find(\Input::get('floor'));
        else $floor = Floors::first();
        # code...
        echo $floor->NAME;
        $image = $floor->IMAGE;

        $myfile = fopen("image", "w+") or die("Unable to open file!");
        fwrite($myfile, $image);
        fclose($myfile);
        list($ancho, $alto, $tipo, $atributos) = getimagesize("image");
        $type = exif_imagetype("image");

        $places = Places::where('FLOOR', '=', $floor->ID)->get();

        return view('floors', ['places' => $places, 'type' => $type, 'ancho' => $ancho, 'alto' => $alto]);

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
}
