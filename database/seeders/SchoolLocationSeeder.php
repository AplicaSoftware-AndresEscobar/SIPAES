<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;

use App\Repositories\SchoolLocationRepository;

class SchoolLocationSeeder extends Seeder
{
    use InteractsWithIO;

    /** @var SchoolLocationRepository */
    protected $schoolLocationRepository;

    public function __construct(SchoolLocationRepository $schoolLocationRepository)
    {
        $this->schoolLocationRepository = $schoolLocationRepository;
        $this->output = new ConsoleOutput();
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schoolLocationsArray = config('database.default-data.school_locations');

        $this->info('Creando las sedes disponibles para la aplicación');

        $this->command->getOutput()->progressStart(count($schoolLocationsArray));

        foreach ($schoolLocationsArray as $schoolLocation) {
            $this->info("\n-Creando Sede: '{$schoolLocation['name']}'\n");
            sleep(1);
            $this->schoolLocationRepository->create($schoolLocation);
            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();
    }
}
