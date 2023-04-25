<?php

namespace App\Repositories;

use App\Models\UserWorkExperiencie;

class UserWorkExperiencieRepository extends AbstractRepository
{
    public function __construct(UserWorkExperiencie $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $params
     * @param array $with
     * @param array $withCount
     * 
     * @return $query
     */
    public function search(array $params = [], array $with = [], array $withCount = [])
    {
        $query = $this->model
            ->select();

        if (isset($params['id']) && $params['id']) {
            $query->byId($params['id']);
        }

        if (isset($params['user_id']) && $params['user_id']) {
            $query->byUser($params['user_id']);
        }

        if (isset($params['company_id']) && $params['company_id']) {
            $query->byCompany($params['company_id']);
        }

        if (isset($params['job_title']) && $params['job_title']) {
            $query->byJob($params['job_title']);
        }

        if (isset($with) && $with) {
            $query->with($with);
        }

        if (isset($withCount) && $withCount) {
            $query->withCount($withCount);
        }

        return $query;
    }
}
