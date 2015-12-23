<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticketlines extends Model
{
   
	public $timestamps = false;
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'TICKETLINES';

    /**      * The attributes that are mass assignable.      *      * @var
array      */     
	protected $fillable = ['TICKET', 'LINE', 'PRODUCT', 'ATTRIBUTESETINSTANCE_ID', 'UNITS', 'PRICE', 'TAXID'];

	public function ticket()
    {
        return $this->belongsTo('App\Tickets', 'TICKET', 'ID');
    }	

    public function product()
    {
        return $this->belongsTo('App\Products', 'PRODUCT', 'ID');
    }

}
