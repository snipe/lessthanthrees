<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;
use DB;

class User extends Authenticatable
{
    use Notifiable;
    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'password', 'provider', 'provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function items() {
        return $this->hasMany('\App\Item');
    }

    /**
     * Return a user's social accounts.
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @since  [v1.0]
     * @return collection
     */
    public function social()
    {
        return $this->hasMany('App\Social', 'user_id');
    }

    /**
     * Stores the social accounts associated with a user.
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @param object $socialUser
     * @param string $provider
     * @since  [v1.0]
     * @return mixed
     */
    public static function saveSocialAccount($socialUser, $provider)
    {
        // Check to see if a user exists in the users table first
        $user =  User::where('email', '=', $socialUser->getEmail())->first();

        // There is NOT a matching email address in the user table
        if (!$user) {
            $user = new User;
            $user->email = $socialUser->getEmail();
            $user->first_name = $socialUser->getName();
            $user->display_name = $socialUser->getName();
            if (!$user->save()) {
                return false;
            }
        }

        $social = $user->social()->firstOrNew(
            ['user_id' => $user->id,
                'service'=>$provider,
                'uid' => $socialUser->getId()
            ]
        );

        $social->access_token = $socialUser->token;
        $social->save();

        return $user;
    }

    /**
     * Checks to see if a user's social info has already been saved
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @param object $community
     * @since  [v1.0]
     * @return User
     */
    public static function checkForSocialLoginDBRecord($user, $provider)
    {
        return DB::table('social')
            ->where('access_token', '=', $user->token)
            ->where('service', '=', $provider)
            ->get();
    }
}
