<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/19/2016
 * Time: 11:09 PM
 */
namespace App\Services;

use App\Contracts\GoogleInterface;
use App\User;
use Illuminate\Contracts\Auth\Guard;
use League\OAuth2\Client\Provider\Google;




class GoogleService implements GoogleInterface
{

    protected $user;
    protected $auth;
    protected $google;


    public function __construct(User $user,Guard $auth)
    {

        if(session_id() == '') {
            session_start();
        }
        $this->user = $user;
        $this->auth = $auth;
        $this->google =  new Google([
            'clientId'     => '267970495650-njsnvm7nuou4sct09kv1r3c4d08m5rta.apps.googleusercontent.com',
            'clientSecret' => 'cZkN51LeqBSHKebhfRVe6uV-',
            'redirectUri'  => 'http://laravel.dev/google/callback',
            'hostedDomain' => 'http://laravel.dev',
        ]);
    }

    public function getGoogleLoginUrl()
    {
        $authUrl = $this->google->getAuthorizationUrl();
        return $authUrl;
    }

    public function getUserData()
    {
        $token = $this->google->getAccessToken('authorization_code', [
            'code' => $_GET['code']
        ]);
        //dd($token);
        // Optional: Now you have a token you can look up a users profile data
        try {
            //dd('asd');

            // We got an access token, let's now get the owner details
            $ownerDetails = $this->google->getResourceOwner($token);

            // Use these details to create a new profile

            return $ownerDetails;

        } catch (Exception $e) {

            // Failed to get user details
            exit('Something went wrong: ' . $e->getMessage());

        }
    }

    public function loginOrRegister()
    {
        $users_data = $this->getUserData()->toArray();
        if(isset($users_data['id'])){
            $user = $this->user->where('google_id', $users_data['id'])->first();
            if($user){
                $this->auth->login($user);
                return true;
            } else {
                if(isset($users_data['emails'][0]['value'])){
                    $user = $this->user->where('email', $users_data['emails'][0]['value'])->first();
                    //dd($user);
                    if($user){
                        $this->auth->login($user);
                        return true;
                    }
                    else{
                        //dd($users_data['image']['url'],(int)$users_data['id']);
                        $users_table_inputs = array('name' => $users_data['displayName'],'google_id'  => (int)$users_data['id'], 'email' => $users_data['emails'][0]['value'],'avatar' => $users_data['image']['url'], 'password' => '');
                        $user = $this->user->create($users_table_inputs);
                        if($user){
                            $this->auth->login($user);
                            return true;
                        }
                    }
                }

            }

        }
        return false;
    }



}