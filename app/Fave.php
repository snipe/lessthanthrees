<?php
namespace App;

use Illuminate\Database\Eloquent\Model;



class Fave extends Model
{
    protected $table = 'user_likes';

    protected $fillable = ['user_id','item_id'];

    public function items()
    {
        return $this->belongsTo('\App\Item', 'item_id');
    }


    public function user()
    {
        return $this->belongsTo('\App\User', 'user_id');
    }
}
