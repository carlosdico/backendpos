<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ticketlines;

class Payments extends Model
{
   
	public $timestamps = false;
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'PAYMENTS';

    /**      * The attributes that are mass assignable.      *      * @var
array      */     
	protected $fillable = ['ID', 'RECEIPT', 'PAYMENT', 'TOTAL', 'TRANSID', 'RETURNMSG', 'NOTES', 'TENDERED', 'CARDNAME'];

    public function ticketlines()
    {
        return $this->hasMany('App\Ticketlines', 'TICKET', 'ID');
    }
    
    public function tickets()
    {
        return $this->hasOne('App\Tickets', 'ID', 'ID');
    }  

}