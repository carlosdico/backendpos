<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Receipts;

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

    public function receipts()
    {
        return $this->hasone('App\Receipts', 'ID', 'ID');
    }

    public function person()
    {
        return $this->hasone('App\People', 'ID', 'PERSON');
    }


}
