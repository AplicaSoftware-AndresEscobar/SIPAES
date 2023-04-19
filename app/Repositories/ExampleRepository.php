<?php

namespace App\Repositories;

use App\Models\User;

class ExampleRepository extends AbstractRepository
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
