<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Center extends Model
{
    protected $table = 'centers';

    public function sites()
    {
        return $this->belongsToMany('App\\Models\\Site', 'center_sites', 'center_id', 'site_id');
    }
}
