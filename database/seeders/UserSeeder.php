<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;

use App\Repositories\UserRepository;
use App\Repositories\AcademicStudyLevelRepository;
use App\Repositories\DocumentTypeRepository;
use App\Repositories\EducationalInstituteRepository;
use App\Repositories\GenderRepository;
use App\Repositories\Localization\CityRepository;
use App\Repositories\UserInformationRepository;


use App\Models\EducationalInstitute;
use App\Models\AcademicStudyLevel;
use App\Models\User;
use App\Repositories\UserAcademicStudyRepository;

class UserSeeder extends Seeder
{
    use InteractsWithIO;

    /** @var UserRepository */
    protected $userRepository;

    /** @var UserInformationRepository */
    protected $userInformationRepository;

    /** @var UserAcademicStudyRepository */
    protected $userAcademicStudyRepository;

    /** @var DocumentTypeRepository */
    protected $documentTypeRepository;

    /** @var CityRepository */
    protected $cityRepository;

    /** @var GenderRepository */
    protected $genderRepository;

    /** @var AcademicStudyLevelRepository */
    protected $academicStudyLevelRepository;

    /** @var EducationalInstituteRepository */
    protected $educationalInstituteRepository;

    public function __construct(
        UserRepository $userRepository,
        UserInformationRepository $userInformationRepository,
        UserAcademicStudyRepository $userAcademicStudyRepository,
        DocumentTypeRepository $documentTypeRepository,
        CityRepository $cityRepository,
        GenderRepository $genderRepository,
        AcademicStudyLevelRepository $academicStudyLevelRepository,
        EducationalInstituteRepository $educationalInstituteRepository,
    ) {
        $this->userRepository = $userRepository;
        $this->userInformationRepository = $userInformationRepository;
        $this->userAcademicStudyRepository = $userAcademicStudyRepository;
        $this->documentTypeRepository = $documentTypeRepository;
        $this->cityRepository = $cityRepository;
        $this->genderRepository = $genderRepository;
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

        /** .Complement Data */

        $usersNum = (int) $this->command->ask("¿Cuántos Usuarios desea crear para el ambiente de desarrollo? \nPor defecto se crearán 5 usuarios.", 5);
        $usersNum = !is_numeric($usersNum) || $usersNum <= 0 ? 5 : $usersNum;
        $users = $this->userRepository->createFactory($usersNum);
        $this->command->getOutput()->progressStart(count($users));

        foreach ($users as $userItem) {
            /** @var User $userItem */

            /** @var \App\Models\DocumentType $randomDocumentType */
            $randomDocumentType = $documentTypes->random(1)->first();

            /** @var \App\Models\Localization\City $randomCity */
            $randomCity = $cities->random(1)->first();

            /** @var \App\Models\Gender $randomGender */
            $randomGender = $genders->random(1)->first();

            sleep(1);
            $userInformation = $this->userInformationRepository->createOneFactory([
                'user_id' => $userItem->id,
                'gender_id' => $randomGender->id,
                'document_type_id' => $randomDocumentType->id,
                'birthday_place_id' => $randomCity->id
            ]);
            $this->info("\n-Creando Usuario: '{$userInformation->fullname}'\n");

            if (randomBoolean()) $this->hasAcademicStudies($userItem, $academicStudyLevels, $educationalInstitutes);

            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();
    }

    /**
     * @param User $user
     * @param \Illuminate\Database\Eloquent\Collection<AcademicStudyLevel> $academicStudyLevels
     * @param \Illuminate\Database\Eloquent\Collection<EducationalInstitute> $educationalInstitutes
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

        $this->comment('Se ha registrado informaación académica al usuario.');
    }
}
