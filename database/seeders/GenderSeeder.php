<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;

use App\Repositories\GenderRepository;

class GenderSeeder extends Seeder
{
    use InteractsWithIO;

    /** @var GenderRepository */
    protected $genderRepository;

    public function __construct(GenderRepository $genderRepository)
    {
        $this->genderRepository = $genderRepository;
        $this->output = new ConsoleOutput();
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gendersArray = config('database.default-data.genders');

        $this->info('Creando los géneros disponibles para la aplicación');

        $this->command->getOutput()->progressStart(count($gendersArray));

        foreach ($gendersArray as $genderItem) {
            $this->info("\n-Creando Género: '{$genderItem['name']}'\n");
            sleep(1);
            $this->genderRepository->create($genderItem);
            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();
    }
}
