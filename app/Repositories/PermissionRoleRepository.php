<?php

namespace App\Repositories;

use App\Repositories\Interfaces\PermissionRoleRepositoryInterface;
use App\Models\PermissionRole;

class PermissionRoleRepository implements PermissionRoleRepositoryInterface
{
    public function getById($id){
        return PermissionRole::where('role_id', $id)->get();
    }
}
