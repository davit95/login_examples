<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Contracts\FacebookInterface;
use App\Contracts\TwitterInterface;
use App\Contracts\GoogleInterface;

use Socialite;
use Twitter;
use Session;
use Input;
use Redirect;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectPath = '/home';
    //protected $loginPath = '/login';
    protected $redirectAfterLogout = "/";

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
    }

    public function getLogin(FacebookInterface $facebookService, TwitterInterface $twitterService, GoogleInterface $googleService)
    {
        $facebookLoginUrl = $facebookService->getFacebookLoginUrl();
        $twitterLoginUrl  = $twitterService->getTwitterLoginUrl();
        $googleLoginUrl   = $googleService->getGoogleLoginUrl();
        if (view()->exists('auth.authenticate')) {
            return view('auth.authenticate',['facebookLoginUrl' => $facebookLoginUrl,
                                             'twitterLoginUrl' => $twitterLoginUrl,
                                             'googleLoginUrl'  => $googleLoginUrl]);
        }

        return view('auth.login',['facebookLoginUrl' => $facebookLoginUrl, 'twitterLoginUrl' => $twitterLoginUrl, 'googleLoginUrl'  => $googleLoginUrl]);
    }
}
