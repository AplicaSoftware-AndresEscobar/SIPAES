<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;

use App\Repositories\Localization\CountryRepository;
use App\Repositories\Localization\DepartmentRepository;
use App\Repositories\Localization\CityRepository;

class LocalizationSeeder extends Seeder
{
    use InteractsWithIO;

    /** @var CountryRepository */
    protected $countryRepository;

    /** @var DepartmentRepository */
    protected $departmentRepository;

    /** @var CityRepository */
    protected $cityRepository;

    public function __construct(
        CountryRepository $countryRepository,
        DepartmentRepository $departmentRepository,
        CityRepository $cityRepository
    ) {
        $this->countryRepository = $countryRepository;
        $this->departmentRepository = $departmentRepository;
        $this->cityRepository = $cityRepository;

        $this->output = new ConsoleOutput();
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->info('Creando el país de Colombia en la aplicación.');


        /** @var \App\Models\Localization\Country $colombia */
        $colombia = $this->countryRepository->create(array(
            'name' => 'Colombia'
        ));

        $contentFile = Storage::get('colombia.min.json');
        $departmentArray = json_decode($contentFile);

        $this->info('Creando los departamentos de la aplicación');
        $this->command->getOutput()->progressStart(count($departmentArray));

        $departmentsCollection = collect();

        foreach ($departmentArray as $departmentItem) {
            $this->info("\n-Creando Departamento: '{$departmentItem->departamento}'\n");
            /** @var \App\Models\Admin\Localization\State $state */
            $department = $this->departmentRepository->create([
                'country_id' => $colombia->id,
                'name' => $departmentItem->departamento,
            ]);
            $this->command->getOutput()->progressAdvance();

            $departmentsCollection->push(['department' => $department, 'cities' => $departmentItem->ciudades]);
        }
        $this->command->getOutput()->progressFinish();


        foreach ($departmentsCollection as $departmentCollectionItem) {
            $this->info("\n-Registrando los Municipios/Ciudades de: '{$departmentCollectionItem['department']->name}'\n");
            $cities = $departmentCollectionItem['cities'];
            $this->command->getOutput()->progressStart(count($cities));
            foreach ($cities as $cityItem) {
                $this->info("\n-Creando Municipio/Ciudad: '$cityItem'\n");
                /** @var \App\Models\Admin\Localization\City $city */
                $this->cityRepository->updateOrCreate(['name' => $cityItem], [
                    'department_id' => $departmentCollectionItem['department']->id,
                    'name' => $cityItem
                ]);
                $this->command->getOutput()->progressAdvance();
            }
            $this->command->getOutput()->progressFinish();
        }
    }
}
