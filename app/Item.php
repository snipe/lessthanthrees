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
    
    /* Method for getting a list of all saved entries
    We can use ->withPivot('id') hwere later if we need to
    */
    public function faves()
    {
        return $this->belongsToMany('\App\User', 'user_likes', 'item_id', 'user_id');
    }

    public function favedByUser() {

    }



}
