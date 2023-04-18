<?php

namespace Database\Seeders;

use App\Repositories\AcademicStudyLevelRepository;
use Illuminate\Console\Concerns\InteractsWithIO;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Output\ConsoleOutput;

class AcademicStudyLevelSeeder extends Seeder
{
    use InteractsWithIO;

    /** @var AcademicStudyLevelRepository */
    protected $academicStudyLevelRepository;

    public function __construct(AcademicStudyLevelRepository $academicStudyLevelRepository)
    {
        $this->academicStudyLevelRepository = $academicStudyLevelRepository;

        $this->output = new ConsoleOutput();
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $academicStudyLevels = config('database.default-data.academic_study_levels');

        $this->info('Creando todos los niveles académicos de la aplicación');

        $this->command->getOutput()->progressStart(count($academicStudyLevels));

        foreach ($academicStudyLevels as $academicStudyLevel) {
            $this->info("\n-Creando Nivel Académico: '{$academicStudyLevel['name']}'\n");
            sleep(1);
            $this->academicStudyLevelRepository->create($academicStudyLevel);
            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();
    }
}
