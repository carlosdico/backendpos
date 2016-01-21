<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
   
	public $timestamps = false;
    //
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'CATEGORIES';

    /**      * The attributes that are mass assignable.      *      * @var
array      */     
	protected $fillable = ['ID', 'NAME', 'PARENTID', 'IMAGE', 'TEXTTIP', 'CATSHOWNAME'];

	public function parent()
    {
        return $this->hasOne('App\Categories', 'ID', 'PARENTID');
    }

}