<?php

namespace App\Repositories\Localization;

use App\Repositories\AbstractRepository;

use App\Models\Localization\City;

class CityRepository extends AbstractRepository
{
    public function __construct(City $model)
    {
        $this->model = $model;
    }
}
