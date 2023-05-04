<?php

namespace App\Repositories;

use App\Models\UserAcademicStudy;

class UserAcademicStudyRepository extends AbstractRepository
{
    public function __construct(UserAcademicStudy $model)
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

        if (isset($params['educational_institute_id']) && $params['educational_institute_id']) {
            $query->byEducationalInstitute($params['educational_institute_id']);
        }

        if (isset($params['academic_study_level_id']) && $params['academic_study_level_id']) {
            $query->byAcademicStudyLevel($params['academic_study_level_id']);
        }

        if (isset($params['degree']) && $params['degree']) {
            $query->byDegree($params['degree']);
        }

        if (isset($params['year']) && $params['year']) {
            $query->byYear($params['year']);
        }

        if (isset($with) && $with) {
            $query->with($with);
        }

        $query->orderBy('year');

        if (isset($withCount) && $withCount) {
            $query->withCount($withCount);
        }

        return $query;
    }
}
