<?php

namespace App\Repositories;

use App\Models\Permission;

class PermissionRepository extends AbstractRepository
{
    public function __construct(Permission $model)
    {
        $this->model = $model;
    }
}
