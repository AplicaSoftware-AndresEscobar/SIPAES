<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Console\Concerns\InteractsWithIO;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Symfony\Component\Console\Output\ConsoleOutput;

use App\Repositories\UserRepository;
use App\Repositories\UserInformationRepository;
use App\Repositories\UserAcademicStudyRepository;
use App\Repositories\UserWorkExperiencieRepository;
use App\Repositories\CompanyRepository;
use App\Repositories\EducationalInstituteRepository;
use App\Repositories\AcademicStudyLevelRepository;
use App\Repositories\DocumentTypeRepository;
use App\Repositories\GenderRepository;
use App\Repositories\Localization\CityRepository;


use App\Models\EducationalInstitute;
use App\Models\AcademicStudyLevel;
use App\Models\Company;
use App\Models\DocumentType;
use App\Models\Gender;
use App\Models\User;
use App\Models\Localization\City;

class UserSeeder extends Seeder
{
    use InteractsWithIO;

    /** @var UserRepository */
    protected $userRepository;

    /** @var UserInformationRepository */
    protected $userInformationRepository;

    /** @var UserAcademicStudyRepository */
    protected $userAcademicStudyRepository;

    /** @var UserWorkExperiencieRepository */
    protected $userWorkExperiencieRepository;

    /** @var DocumentTypeRepository */
    protected $documentTypeRepository;

    /** @var CityRepository */
    protected $cityRepository;

    /** @var GenderRepository */
    protected $genderRepository;

    /** @var CompanyRepository */
    protected $companyRepository;

    /** @var AcademicStudyLevelRepository */
    protected $academicStudyLevelRepository;

    /** @var EducationalInstituteRepository */
    protected $educationalInstituteRepository;

    public function __construct(
        UserRepository $userRepository,
        UserInformationRepository $userInformationRepository,
        UserAcademicStudyRepository $userAcademicStudyRepository,
        UserWorkExperiencieRepository $userWorkExperiencieRepository,
        DocumentTypeRepository $documentTypeRepository,
        CityRepository $cityRepository,
        GenderRepository $genderRepository,
        CompanyRepository $companyRepository,
        AcademicStudyLevelRepository $academicStudyLevelRepository,
        EducationalInstituteRepository $educationalInstituteRepository,
    ) {
        $this->userRepository = $userRepository;
        $this->userInformationRepository = $userInformationRepository;
        $this->userAcademicStudyRepository = $userAcademicStudyRepository;
        $this->userWorkExperiencieRepository = $userWorkExperiencieRepository;
        $this->documentTypeRepository = $documentTypeRepository;
        $this->cityRepository = $cityRepository;
        $this->genderRepository = $genderRepository;
        $this->companyRepository = $companyRepository;

        $this->academicStudyLevelRepository = $academicStudyLevelRepository;
        $this->educationalInstituteRepository = $educationalInstituteRepository;

        $this->output = new ConsoleOutput();
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /** Complement Data */
        $documentTypes = $this->documentTypeRepository->all(['id']);
        $cities = $this->cityRepository->all(['id']);
        $genders = $this->genderRepository->all(['id']);
        $academicStudyLevels = $this->academicStudyLevelRepository->all(['id']);
        $educationalInstitutes = $this->educationalInstituteRepository->all(['id']);
        $companies = $this->companyRepository->all(['id']);

        /** Create Superadmin */
        $user = $this->createSuperAdmin();
        $this->createUserInformation($user, $documentTypes, $cities, $genders);
        $this->hasWorkExperiencies($user, $companies);
        $this->hasAcademicStudies($user, $academicStudyLevels, $educationalInstitutes);

        /** .Complement Data */
        $usersNum = (int) $this->command->ask("¿Cuántos Usuarios desea crear para el ambiente de desarrollo? \nPor defecto se crearán 5 usuarios.", 5);
        $usersNum = !is_numeric($usersNum) || $usersNum <= 0 ? 5 : $usersNum;
        $users = $this->userRepository->createFactory($usersNum);
        $this->command->getOutput()->progressStart(count($users));

        foreach ($users as $userItem) {
            $this->createUserInformation($userItem, $documentTypes, $cities, $genders);

            if (randomBoolean()) $this->hasAcademicStudies($userItem, $academicStudyLevels, $educationalInstitutes);

            if (randomBoolean()) $this->hasWorkExperiencies($userItem, $companies);
            
            $userItem->assignRole('admin');

            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();
    }

    /** 
     * Create Super Admin
     * 
     * @return User
     */
    private function createSuperAdmin()
    {
        /** @var User $user */
        $user = $this->userRepository->create([
            'username' => 'superadmin-sipaes',
            'email' => 'superadmin@gmail.com',
            'password' => 'password', // password
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        $this->info("\n-Se ha creado satisfactoriamente el usuario superadministrador\n");
        $user->assignRole('super-admin');
        return $user;
    }

    /**
     * @param User $user
     * @param Collection<DocumentType> $documentTypes
     * @param Collection<City> $cities
     * @param Collection<Gender> $genders
     */
    private function createUserInformation($user, $documentTypes, $cities, $genders)
    {
        /** @var \App\Models\DocumentType $randomDocumentType */
        $randomDocumentType = $documentTypes->random(1)->first();

        /** @var \App\Models\Localization\City $randomCity */
        $randomCity = $cities->random(1)->first();

        /** @var \App\Models\Gender $randomGender */
        $randomGender = $genders->random(1)->first();

        $userInformation = $this->userInformationRepository->createOneFactory([
            'user_id' => $user->id,
            'gender_id' => $randomGender->id,
            'document_type_id' => $randomDocumentType->id,
            'birthday_place_id' => $randomCity->id
        ]);
        $this->info("\n-Creando Usuario: '{$userInformation->fullname}'\n");
    }

    /**
     * @param User $user
     * @param Collection<AcademicStudyLevel> $academicStudyLevels
     * @param Collection<EducationalInstitute> $educationalInstitutes
     */
    private function hasAcademicStudies($user, $academicStudyLevels, $educationalInstitutes)
    {
        $randomStudiesNumber = rand(1, 4);

        for ($i = 0; $i < $randomStudiesNumber; $i++) {
            /** @var AcademicStudyLevel $randomAcademicStudyLevel */
            $randomAcademicStudyLevel = $academicStudyLevels->random(1)->first();

            /** @var EducationalInstitute $randomEducationalInstitute */
            $randomEducationalInstitute = $educationalInstitutes->random(1)->first();

            $this->userAcademicStudyRepository->createOneFactory([
                'user_id' => $user->id,
                'academic_study_level_id' => $randomAcademicStudyLevel->id,
                'educational_institute_id' => $randomEducationalInstitute->id
            ]);
        }

        $this->comment('Se ha registrado información académica al usuario.');
    }

    /**
     * @param User $user
     * @param Collection<Company> $companies
     */
    private function hasWorkExperiencies($user, $companies)
    {
        $randomWorkExperiencies = rand(1, 4);

        for ($i = 0; $i < $randomWorkExperiencies; $i++) {
            /** @var Company $randomCompany */
            $randomCompany = $companies->random(1)->first();

            $this->userWorkExperiencieRepository->createOneFactory([
                'user_id' => $user->id,
                'company_id' => $randomCompany->id,
            ]);
        }

        $this->comment('Se ha registrado experiencias laborales al usuario.');
    }
}
