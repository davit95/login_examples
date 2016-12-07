<?php
namespace App\Contracts;

interface FacebookInterface
{
    // return facebook login url
    public function getFacebookLoginUrl();

    //return user data
    public function getUserData($fb_user_data_fields);

    //login or register user
    public function loginOrRegister();
}
