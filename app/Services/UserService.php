<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/18/2016
 * Time: 10:38 PM
 */
namespace App\Services;

use App\Contracts\CategoryInterface;
use App\Contracts\UserInterface;
use App\Models\User;
use App\Models\Country;
use Illuminate\Contracts\Auth\Guard;
use DB;
use Exception;






class UserService implements UserInterface
{
    protected $users;
    protected $user;

    public function __construct(User $users,Guard $auth, Country $country)
    {
        $this->users = $users;
        $this->user = $auth;
        $this->country = $country;
    }

    /*
     *  return all users
     *
     * */
    public function getAllUsers()
    {
        $id = $this->user->id();
        return $this->users->with('countries')->get();
       // return $this->users->find($id)->countries->get();
    }

    public function addUser($inputs)
    {
        DB::beginTransaction();
        try {
            $user =  $this->users->create($inputs);
        }
        catch(Exeption $e) {
            $e->getMessage();
            DB::rolleback();
        }
        try {
            $this->users->get();
        }
        catch(Exeption $e) {
            $e->getMessage();
            DB::rolleback();
        }

         DB::commit();
    }



}