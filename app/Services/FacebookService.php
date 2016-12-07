<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/18/2016
 * Time: 10:38 PM
 */
namespace App\Services;

use App\Contracts\FacebookInterface;
use \Facebook\Facebook;
use App\User;
use Illuminate\Contracts\Auth\Guard;



class FacebookService implements FacebookInterface
{
    protected $facebook;
    protected $user;
    protected $auth;

    public function __construct(User $user,Guard $auth)
    {
        if(session_id() == '') {
            session_start();
        }
        $this->facebook = new Facebook([
            'app_id' => '1575355352754473',
            'app_secret' => '903aace7cd3a664a926b87ecbf37b80a',
            'default_graph_version' => 'v2.2',
        ]);
        $this->user = $user;
        $this->auth = $auth;
    }

    public function getFacebookLoginUrl()
    {
        $helper = $this->facebook->getRedirectLoginHelper();
        $permissions = ['email']; // Optional permissions
        $loginUrl = $helper->getLoginUrl('http://laravel.dev/fb-callback', $permissions);
        return htmlspecialchars($loginUrl);
    }

    public function getUserData($fb_user_data_fields)
    {
        $helper = $this->facebook->getRedirectLoginHelper();

        try {
            $accessToken = $helper->getAccessToken();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        if (! isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            exit;
        }
        $this->facebook->setDefaultAccessToken($accessToken->getValue());
        $profile_request = $this->facebook->get('/me?fields='.$fb_user_data_fields);
        $users_data = $profile_request->getGraphNode()->asArray();
        //dd($users_data);
        return $users_data;
    }

    public function loginOrRegister()
    {
        $users_data = $this->getUserData('name,first_name,last_name,email,id');
        if(isset($users_data['id'])){
            $user = $this->user->where('id', $users_data['id'])->first();
            if($user){
                $this->auth->login($user);
                return true;
            } else {
                if(isset($users_data['email'])){
                    $user = $this->user->where('email', $users_data['email'])->first();
                    if($user){
                        $this->auth->login($user);
                        return true;
                    }
                    else{
                   // dd($users_data['id']);
                    $users_table_inputs = array('name' => $users_data['name'], 'email' => $users_data['email'], 'password' => '','facebook_id' => $users_data['id']);
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