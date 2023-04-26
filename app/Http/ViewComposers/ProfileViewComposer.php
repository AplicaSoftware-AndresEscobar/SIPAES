<?php

namespace App\Http\ViewComposers;

use App\Repositories\AcademicStudyLevelRepository;
use App\Repositories\CompanyRepository;
use App\Repositories\EducationalInstituteRepository;
use Illuminate\View\View;

class ProfileViewComposer
{
    /** @var CompanyRepository */
    protected $companyRepository;

    /** @var EducationalInstituteRepository */
    protected $educationalInstituteRepository;

    /** @var AcademicStudyLevelRepository */
    protected $academicStudyLevelRepository;

    public function __construct(
        CompanyRepository $companyRepository,
        EducationalInstituteRepository $educationalInstituteRepository,
        AcademicStudyLevelRepository $academicStudyLevelRepository,

    ) {
        $this->companyRepository = $companyRepository;
        $this->educationalInstituteRepository = $educationalInstituteRepository;
        $this->academicStudyLevelRepository = $academicStudyLevelRepository;
    }

    public function compose(View $view)
    {
        $userWorkExperiencies = current_user()->work_experiencies;

        $userAcademicStudies = current_user()->academic_studies;

        $companies = $this->companyRepository->all()->pluck('name', 'id')->prepend('---Seleccione una ', -1);

        $institutes = $this->educationalInstituteRepository->all()->pluck('name', 'id')->prepend('--Seleccionar una', -1);

        $studyLevels = $this->academicStudyLevelRepository->all()->pluck('name', 'id')->prepend('--- Seleccionar una', -1);

        $view->with(compact('companies', 'institutes', 'studyLevels', 'userWorkExperiencies'));
    }
}
