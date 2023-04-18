<?php

namespace Database\Seeders;

use App\Repositories\DocumentTypeRepository;
use App\Repositories\GenderRepository;
use App\Repositories\Localization\CityRepository;
use App\Repositories\UserInformationRepository;
use Illuminate\Database\Seeder;

use App\Repositories\UserRepository;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;

class UserSeeder extends Seeder
{
    use InteractsWithIO;

    /** @var UserRepository */
    protected $userRepository;

    /** @var UserInformationRepository */
    protected $userInformationRepository;

    /** @var DocumentTypeRepository */
    protected $documentTypeRepository;

    /** @var CityRepository */
    protected $cityRepository;

    /** @var GenderRepository */
    protected $genderRepository;

    public function __construct(
        UserRepository $userRepository,
        UserInformationRepository $userInformationRepository,
        DocumentTypeRepository $documentTypeRepository,
        CityRepository $cityRepository,
        GenderRepository $genderRepository
    ) {
        $this->userRepository = $userRepository;
        $this->userInformationRepository = $userInformationRepository;
        $this->documentTypeRepository = $documentTypeRepository;
        $this->cityRepository = $cityRepository;
        $this->genderRepository = $genderRepository;

        $this->output = new ConsoleOutput();
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $documentTypes = $this->documentTypeRepository->all(['id']);
        $cities = $this->cityRepository->all(['id']);
        $genders = $this->genderRepository->all(['id']);

        $usersNum = (int)$this->command->ask("¿Cuántos Usuarios desea crear para el ambiente de desarrollo? \nPor defecto se crearán 5 usuarios.", 5);
        $usersNum = !is_numeric($usersNum) || $usersNum <= 0 ? 5 : $usersNum;
        $users = $this->userRepository->createFactory($usersNum);
        $this->command->getOutput()->progressStart(count($users));

        foreach ($users as $userItem) {
            /** @var \App\Models\DocumentType $randomDocumentType */
            $randomDocumentType = $documentTypes->random(1)->first();

            /** @var \App\Models\Localization\City $randomCity */
            $randomCity = $cities->random(1)->first();

            /** @var \App\Models\Gender $randomGender */
            $randomGender = $genders->random(1)->first();

            sleep(1);
            $user = $this->userInformationRepository->createOneFactory([
                'user_id' => $userItem->id,
                'gender_id' => $randomGender->id,
                'document_type_id' => $randomDocumentType->id,
                'birthday_place_id' => $randomCity->id
            ]);
            $this->info("\n-Creando Usuario: '{$user->fullname}'\n");
            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();
    }
}
