<?php

namespace App\Repositories\Localization;

use App\Repositories\AbstractRepository;

use App\Models\Localization\Department;

class DepartmentRepository extends AbstractRepository
{
    public function __construct(Department $model)
    {
        $this->model = $model;
    }
}
