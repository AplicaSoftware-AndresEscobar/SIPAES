<?php

namespace App\Repositories;

use App\Models\UserInformation;

class UserInformationRepository extends AbstractRepository
{
    public function __construct(UserInformation $model)
    {
        $this->model = $model;
    }
}
