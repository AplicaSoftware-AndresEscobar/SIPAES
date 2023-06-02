<?php

namespace App\Repositories;

use App\Models\Journey;

class JourneyRepository extends AbstractRepository
{
    public function __construct(Journey $model)
    {
        $this->model = $model;
    }
}
