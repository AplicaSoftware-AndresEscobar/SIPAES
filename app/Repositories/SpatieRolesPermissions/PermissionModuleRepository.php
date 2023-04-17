<?php

namespace App\Repositories\SpatieRolesPermissions;

use App\Repositories\AbstractRepository;

use App\Models\SpatieRolesPermissions\PermissionModule;

class PermissionModuleRepository extends AbstractRepository
{
    public function __construct(PermissionModule $model)
    {
        $this->model = $model;
    }
}
