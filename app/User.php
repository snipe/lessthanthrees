<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;
use DB;
use App\Fave;
use Auth;
use Watson\Validating\ValidatingTrait;

class User extends Authenticatable
{
    use Notifiable;
    use Billable;
    use ValidatingTrait;

    /**
     * Model validation rules
     *
     * @var array
     */

    protected $rules = [
        'name'              => 'required|string|min:1',
        'username'                => 'required|string|min:2|max:60|not_in:www,support,admin|unique:users',
        'email'                   => 'required|email|max:255|unique:users',
    ];

    /**
     * Whether the model should inject it's identifier to the unique
     * validation rules before attempting validation. If this property
     * is not set in the model it will default to true.
     *
     * @var boolean
     */
    protected $injectUniqueIdentifier = true;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password'
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

        $user =  User::where('email', '=', $socialUser->getEmail())->first();

        // There is NOT a matching email address in the user table
        if (!$user) {
            $user = new User;
            $user->email = $socialUser->getEmail();
            $user->name = $socialUser->getName();
            if ($socialUser->getNickname()=='') {
                $user->username = str_slug($socialUser->getName());
            } else {
                $user->username = str_slug($socialUser->getNickname());
            }

            if (!$user->save()) {
                return false;
            }
        }

        $social = $user->social()->firstOrNew(
            [
                'user_id' => $user->id,
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
     * @param object $socialUser
     * @param string $provider
     * @since  [v1.0]
     * @return User
     */
    public static function checkForSocialLoginDBRecord($socialUser, $provider)
    {

        return User::whereHas('social', function ($query) use ($socialUser, $provider) {
            $query->where('access_token', '=', $socialUser->token)
                ->where('service', '=', $provider);
        })->first();

    }


    public function getProfileUrl() {
        return 'https://'.$this->username.'.'.config('app.domain');
    }

    /**
     * Return the URL of the user's avatar (or gravatar)
     *
     * @author [A. Gianotto] [<snipe@snipe.net>]
     * @param string $size
     * @since  [v1.0]
     * @return string
     */
    public function gravatar($size = null)
    {
        return "https://gravatar.com/avatar/".md5(strtolower(trim($this->email)))."?d=mm&s=200";
    }


    /* Method for getting a list of all saved entries */
    public function faves()
    {
        return $this->hasMany('\App\Fave','user_id');
    }

    public function isSubscriber() {
        if (Auth::check() && Auth::user()->subscribed('monthly')) {
            return true;
        }

        return false;
    }

    public function profilePasswordIsRequired($request = null)
    {

        if ((($request) && ($request->has('password'))) || ($this->password=='')) {
            return true;
        }

        return false;
    }
}
