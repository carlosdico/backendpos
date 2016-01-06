<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taxes extends Model
{
   
	public $timestamps = false;
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'TAXES';

    /**      * The attributes that are mass assignable.      *      * @var
array      */     
	protected $fillable = ['ID', 'NAME', 'CATEGORY', 'RATE'];

	/*public function ticket()
    {
        return $this->hasOne('App\Tickets');
    }*/

}
