<?php

namespace App\Repositories;

use App\Models\Role;

class RoleRepository extends AbstractRepository
{
    public function __construct(Role $model)
    {
        $this->model = $model;
    }
}
