<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Item;


class Category extends Model
{
    protected $table = "categories";
    public $timestamps = true;

    public function items() {
        return $this->hasMany('\App\Item');
    }

}
