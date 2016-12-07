<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 2/18/2016
 * Time: 10:38 PM
 */
namespace App\Services;

use App\Contracts\CenterInterface;
use App\Models\Center;
use Illuminate\Contracts\Auth\Guard;




class CenterService implements  CenterInterface
{
    protected $center;
    protected $user;

    public function __construct(Center $center, Guard $auth)
    {
        $this->center = $center;
    }

    public function getAllcenters()
    {
       //return $this->center->with('sites')->get();
        return $this->center->whereHas('sites',function($q){
            $q->whereHas('centerSite',function($q){
                //
            });
        })->get();

    }


}