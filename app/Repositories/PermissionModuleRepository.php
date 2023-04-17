<?php

namespace App\Repositories;

use App\Models\PermissionModule;

class PermissionModuleRepository extends AbstractRepository
{
    public function __construct(PermissionModule $model)
    {
        $this->model = $model;
    }
}
