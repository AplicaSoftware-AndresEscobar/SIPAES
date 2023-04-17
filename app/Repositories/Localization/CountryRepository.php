<?php

namespace App\Repositories\Localization;

use App\Repositories\AbstractRepository;

use App\Models\Localization\Country;

class CountryRepository extends AbstractRepository
{
    public function __construct(Country $model)
    {
        $this->model = $model;
    }
}
