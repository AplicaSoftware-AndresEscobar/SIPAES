<?php

namespace App\Repositories;

use App\Models\Gender;

class GenderRepository extends AbstractRepository
{
    public function __construct(Gender $model)
    {
        $this->model = $model;
    }
}
