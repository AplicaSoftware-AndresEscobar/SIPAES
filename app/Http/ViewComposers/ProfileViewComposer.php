<?php

namespace App\Http\ViewComposers;

use App\Repositories\AcademicStudyLevelRepository;
use App\Repositories\CompanyRepository;
use App\Repositories\DocumentTypeRepository;
use App\Repositories\EducationalInstituteRepository;
use App\Repositories\GenderRepository;
use App\Repositories\Localization\CityRepository;
use Illuminate\View\View;

class ProfileViewComposer
{
    /** @var CompanyRepository */
    protected $companyRepository;

    /** @var EducationalInstituteRepository */
    protected $educationalInstituteRepository;

    /** @var AcademicStudyLevelRepository */
    protected $academicStudyLevelRepository;

    /** @var DocumentTypeRepository */
    protected $documentTypeRepository;

    /** @var CityRepository */
    protected $cityRepository;

    /** @var GenderRepository */
    protected $genderRepository;

    public function __construct(
        CompanyRepository $companyRepository,
        EducationalInstituteRepository $educationalInstituteRepository,
        AcademicStudyLevelRepository $academicStudyLevelRepository,
        DocumentTypeRepository $documentTypeRepository,
        CityRepository $cityRepository,
        GenderRepository $genderRepository

    ) {
        $this->companyRepository = $companyRepository;
        $this->educationalInstituteRepository = $educationalInstituteRepository;
        $this->academicStudyLevelRepository = $academicStudyLevelRepository;
        $this->documentTypeRepository = $documentTypeRepository;
        $this->cityRepository = $cityRepository;
        $this->genderRepository = $genderRepository;
    }

    public function compose(View $view)
    {
        $userWorkExperiencies = current_user()->work_experiencies;

        $userAcademicStudies = current_user()->academic_studies;

        $companies = $this->companyRepository->all()->pluck('name', 'id')->prepend('---Seleccionar una opción ', -1);

        $institutes = $this->educationalInstituteRepository->all()->pluck('name', 'id')->prepend('--Seleccionar una opción', -1);

        $studyLevels = $this->academicStudyLevelRepository->all()->pluck('name', 'id')->prepend('--- Seleccionar una opción', -1);

        $documentTypes = $this->documentTypeRepository->all()->pluck('name', 'id')->prepend('---Seleccionar una opción', -1);

        $cities = $this->cityRepository->all()->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->getLocation()
            ];
        })->pluck('name', 'id')->prepend('---Seleccionar una opción', -1);

        $genders = $this->genderRepository->all()->pluck('name', 'id')->prepend('---Seleccionar una opción', -1);

        $view->with(compact('companies', 'institutes', 'studyLevels', 'userWorkExperiencies', 'documentTypes', 'cities', 'genders'));
    }
}
