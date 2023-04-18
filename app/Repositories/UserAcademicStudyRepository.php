<?php

namespace App\Repositories;

use App\Models\UserAcademicStudy;

class UserAcademicStudyRepository extends AbstractRepository
{
    public function __construct(UserAcademicStudy $model)
    {
        $this->model = $model;
    }
}
