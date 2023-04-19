<?php

namespace App\Repositories;

use App\Models\EducationalInstitute;

class EducationalInstituteRepository extends AbstractRepository
{
    public function __construct(EducationalInstitute $model)
    {
        $this->model = $model;
    }
}
