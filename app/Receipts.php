<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ticketlines;

class Receipts extends Model
{
   
	public $timestamps = false;
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'RECEIPTS';

    /**      * The attributes that are mass assignable.      *      * @var
array      */     
	protected $fillable = ['ID', 'MONEY', 'DATENEW', 'PERSON'];

    public function ticketlines()
    {
        return $this->hasMany('App\Ticketlines', 'TICKET', 'ID');
    }
    
    public function tickets()
    {
        return $this->hasOne('App\Tickets', 'ID', 'ID');
    }  
       
    public function payments()
    {
        return $this->hasMany('App\Payments', 'RECEIPT', 'ID');
    }  

    public function closedcash()
    {
        return $this->hasOne('App\ClosedCash', 'MONEY', 'MONEY');
    }

}
