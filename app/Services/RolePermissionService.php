<?php

namespace App\Services;

use Spatie\Permission\Models\Role;

class RolePermissionService
{
    public function getRoles()
    {
        return Role::all()->pluck('name');
    }
}
