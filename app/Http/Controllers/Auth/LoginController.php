<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Redirect the user to the the social provider authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from the social provider.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {

        try {

            $social_user = Socialite::driver($provider)->user();
            //dd($social_user);

            if ($user = User::checkForSocialLoginDBRecord($social_user, $provider)) {
                Auth::login($user);
                return redirect()->route('home')->with('success', 'You have been logged in!');
            } else {
                $user = User::saveSocialAccount($social_user, $provider);
                Auth::login($user);
                return redirect()->route('home')->with('success', 'Welcome aboard!');
            }

        } catch (InvalidStateException $e) {
            return $this->redirectToProvider($provider);
        } catch (ClientException $e) {
            return $this->redirectToProvider($provider);
        } catch (CredentialsException $e) {
            return $this->redirectToProvider($provider);
        }

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make(
            $data,
            [
                'email' => 'required|email|max:255|unique:users',
                'username' => 'required|max:255|unique:users',
                'password' => 'required|min:6',
                'password_confirmation' => 'required|same:password',
            ]
        );
    }

    /**
    * Create a new user instance after a valid registration.
    *
    * @param  array $data
    * @return User
    */
    protected function create(array $data)
    {
        return User::create(
            [
                'email' => $data['email'],
                'username' => str_slug($data['name']),
                'password' => bcrypt($data['password']),
            ]
        );
    }
}
