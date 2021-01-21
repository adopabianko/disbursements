<?php

namespace App\Models;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    public $guarded = [];

    public function user() {
        return $this->hasMany('App\Models\User', 'role_id');
    }
}