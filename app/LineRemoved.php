<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LineRemoved extends Model
{
   
	public $timestamps = false;
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'LINEREMOVED';

    /**      * The attributes that are mass assignable.      *      * @var
array      */     
	protected $fillable = ['REMOVEDDATE', 'NAME', 'TICKETID', 'PRODUCTID', 'PRODUCTNAME', 'UNITS'];

}