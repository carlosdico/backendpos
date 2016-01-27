<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class People extends Model
{
   
	public $timestamps = false;
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'PEOPLE';

    /**      * The attributes that are mass assignable.      *      * @var
array      */     
	protected $fillable = ['ID', 'NAME', 'CARD', 'ROLE', 'VISIBLE'];



}