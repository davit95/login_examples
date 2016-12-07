<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Country;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['name','email'];
    public $timestamps = false;

    public function countries()
    {
        return $this->hasMany('App\Models\Country');
    }
}
