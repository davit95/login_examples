<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    //

    public function centerSites()
    {
        return $this->hasMany('App\\Models\\CenterSite');
    }
}
