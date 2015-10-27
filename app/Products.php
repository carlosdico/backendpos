<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
   
	public $timestamps = false;
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'PRODUCTS';

    /**      * The attributes that are mass assignable.      *      * @var
array      */     
	protected $fillable = ['ID', 'REFERENCE', 'CODE', 'CODETYPE', 'NAME', 'PRICEBUY', 'PRICESELL', 'PRICESELL1', 'PRICESELL2', 'CATEGORY', 'TAXCAT', 'ATTRIBUTESET_ID', 'STOCKCOST', 'STOCKVOLUME', 'IMAGE', 'ISCOM', 'ISSCALE', 'ISKITCHEN', 'PRINTKB', 'SENDSTATUS', 'ISSERVICE', 'ATTRIBUTES', 'DISPLAY', 'ISVPRICE', 'ISVERPATRIB', 'TEXTTIP', 'WARRANTY', 'STOCKUNITS'];

	/*public function ticket()
    {
        return $this->hasOne('App\Tickets');
    }*/

}
