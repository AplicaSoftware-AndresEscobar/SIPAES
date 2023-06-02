<?php

namespace App\Repositories;

use App\Models\SchoolLocation;

class SchoolLocationRepository extends AbstractRepository
{
    public function __construct(SchoolLocation $model)
    {
        $this->model = $model;
    }
}
