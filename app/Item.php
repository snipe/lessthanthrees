<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Item extends Model
{
    protected $table = "items";
    public $timestamps = true;
}
