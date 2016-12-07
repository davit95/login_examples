<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/19/2016
 * Time: 11:09 PM
 */
namespace App\Services;

use App\Contracts\TwitterInterface;
use App\User;
use Illuminate\Contracts\Auth\Guard;
use Twitter;
use Session;
use Input;
use Redirect;



class TwitterService implements TwitterInterface
{

    protected $user;
    protected $auth;


    public function __construct(User $user,Guard $auth)
    {

        if(session_id() == '') {
            session_start();
        }
        $this->user = $user;
        $this->auth = $auth;
    }

    public function getTwitterLoginUrl()
    {
        $sign_in_twitter = true;
        $force_login = false;
        Twitter::reconfig(['token' => '', 'secret' => '']);
        $token = Twitter::getRequestToken('http://laravel.dev/twitter/callback');

        if (isset($token['oauth_token_secret']))
        {
            $url = Twitter::getAuthorizeURL($token, $sign_in_twitter, $force_login);
            Session::put('oauth_state', 'start');
            Session::put('oauth_request_token', $token['oauth_token']);
            Session::put('oauth_request_token_secret', $token['oauth_token_secret']);
            return $url;
        }
    }

    public function getTwitterUsersParams()
    {
        if (Session::has('oauth_request_token')) {
            $request_token = [
                'token' => Session::get('oauth_request_token'),
                'secret' => Session::get('oauth_request_token_secret'),
            ];
            Twitter::reconfig($request_token);
            $oauth_verifier = false;
            if (Input::has('oauth_verifier')) {
                $oauth_verifier = Input::get('oauth_verifier');
            }
            $token = Twitter::getAccessToken($oauth_verifier);
            if (!isset($token['oauth_token_secret'])) {
                return Redirect::route('twitter.login')->with('flash_error', 'We could not log you in on Twitter.');
            }
            $users_data = Twitter::getCredentials();
            //dd($credentials);
            return (array)$users_data;
        }
    }

    public function loginOrRegister()
    {
        $users_data = $this->getTwitterUsersParams();
        if(isset($users_data['id'])){
            $user = $this->user->where('twitter_id', $users_data['id'])->first();
            if($user){
                $this->auth->login($user);
                return true;
            } else {
                        //dd($users_data['image']['url'],(int)$users_data['id']);
                        $users_table_inputs = array('name' => $users_data['name'],'twitter_id'  => (int)$users_data['id'], 'avatar' => $users_data['profile_image_url_https'], 'password' => '');
                        $user = $this->user->create($users_table_inputs);
                        if($user){
                            $this->auth->login($user);
                            return true;
                        }



            }

        }
        return false;
    }

}