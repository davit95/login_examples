<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/19/2016
 * Time: 11:03 PM
 */

namespace App\Contracts;


interface TwitterInterface {

    //return twitter login url
    public function getTwitterLoginUrl();

    //get user data
    public function getTwitterUsersParams();

}