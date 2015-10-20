<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{

	public $timestamps = false;
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'TICKETS';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['ID', 'TICKETTTYPE', 'PERSON', 'CUSTOMER', 'STATUS'];

}
