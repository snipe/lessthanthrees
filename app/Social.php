<?php
/**
 * This model handles the relationships between users and their
 * social accounts.
 *
 * PHP version 5.5.9
 *
 * @package AnyShare
 * @version v1.0
 */
namespace App;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'social';

    protected $fillable = ['access_token','uid','service'];

    public function user()
    {
        return $this->belongsTo('User', 'user_id');
    }
}
