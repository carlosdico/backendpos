<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Places extends Model
{
    public $timestamps = false;
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'PLACES';

    /**      * The attributes that are mass assignable.      *      * @var
array      */     
	protected $fillable = ['ID', 'NAME', 'X', 'Y', 'FLOOR'];
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
