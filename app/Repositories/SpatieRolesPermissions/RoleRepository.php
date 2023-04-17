<?php

namespace App\Repositories\SpatieRolesPermissions;

use App\Repositories\AbstractRepository;

use App\Models\SpatieRolesPermissions\Role;

class RoleRepository extends AbstractRepository
{
    public function __construct(Role $model)
    {
        $this->model = $model;
    }
}
