<?php

namespace App\Repositories;

use App\Models\UserWorkExperiencie;

class UserWorkExperiencieRepository extends AbstractRepository
{
    public function __construct(UserWorkExperiencie $model)
    {
        $this->model = $model;
    }
}
