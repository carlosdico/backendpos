<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Floors extends Model
{
	public $timestamps = false;
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'FLOORS';

    /**      * The attributes that are mass assignable.      *      * @var
array      */     
	protected $fillable = ['ID', 'NAME'];
/*
    public function ticketlines()
    {
        return $this->hasMany('App\Ticketlines', 'TICKET', 'ID');
    }
    
    public function tickets()
    {
        return $this->hasOne('App\Tickets', 'ID', 'ID');
    }
*/
}
