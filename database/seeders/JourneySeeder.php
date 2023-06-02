<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;

use App\Repositories\JourneyRepository;

class JourneySeeder extends Seeder
{
    use InteractsWithIO;

    /** @var JourneyRepository */
    protected $journeyRepository;

    public function __construct(JourneyRepository $journeyRepository)
    {
        $this->journeyRepository = $journeyRepository;
        $this->output = new ConsoleOutput();
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $journeysArray = config('database.default-data.journeys');

        $this->info('Creando las jornadas disponibles para la aplicación');

        $this->command->getOutput()->progressStart(count($journeysArray));

        foreach ($journeysArray as $journey) {
            $this->info("\n-Creando Jornada: '{$journey['name']}'\n");
            $this->journeyRepository->create($journey);
            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();
    }
}
