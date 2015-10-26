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

}
