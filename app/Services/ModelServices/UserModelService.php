<?php

namespace App\Services\ModelServices;

use App\Services\AbstractModelService;

use App\Repositories\UserRepository;

class UserModelService extends AbstractModelService
{
    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->baseRepository = $userRepository;
    }

    /**
     * @param \App\Models\User $user
     * @param int $companyId
     * @param array $workExperienceData
     */
    public function attachWorkExperience($user, $companyId, $workExperienceData)
    {
        $user->work_experiencies()->attach($companyId, $workExperienceData);
    }

    /**
     * @param \App\Models\User $user
     * @param int $workExperienceId
     */
    public function detachWorkExperience($user, $workExperienceId)
    {
        $user->work_experiencies()->find($workExperienceId)->delete();
    }
}
