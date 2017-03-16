<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\User;

class Fave extends Model
{
    protected $table = 'user_likes';

    protected $fillable = ['user_id','item_id'];

    public function item()
    {
        return $this->belongsTo('Item', 'item_id');
    }


    public function user()
    {
        return $this->belongsTo('User', 'user_id')->withTrashed();
    }
}
