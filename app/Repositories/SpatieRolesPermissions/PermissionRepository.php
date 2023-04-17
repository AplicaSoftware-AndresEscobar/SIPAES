<?php

namespace App\Repositories\SpatieRolesPermissions;

use App\Repositories\AbstractRepository;

use App\Models\SpatieRolesPermissions\Permission;

class PermissionRepository extends AbstractRepository
{
    public function __construct(Permission $model)
    {
        $this->model = $model;
    }
}
