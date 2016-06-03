<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrawerOpened extends Model
{
   
	public $timestamps = false;
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'DRAWEROPENED';

    /**      * The attributes that are mass assignable.      *      * @var
array      */     
	protected $fillable = ['OPENDATE', 'NAME', 'TICKETID'];

}