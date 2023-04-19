<?php

namespace App\Repositories;

use App\Models\AcademicStudyLevel;

class AcademicStudyLevelRepository extends AbstractRepository
{
    public function __construct(AcademicStudyLevel $model)
    {
        $this->model = $model;
    }
}
