<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Item extends Model
{
    protected $table = "items";
    public $timestamps = true;

    public function author() {
        return $this->belongsTo('\App\User');
    }

    public function category() {
        return $this->belongsTo('\App\Category');
    }



    /* Method for getting a list of all saved entries */
    public function faves()
    {
        return $this->hasMany('Fave','item_id');
    }



}
