<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;

class EducationalInstituteSeeder extends Seeder
{
    use InteractsWithIO;

    public function __construct()
    {
        $this->output = new ConsoleOutput();
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!isProductionEnv()) {
            $educationalInstituteNum = (int)$this->command->ask("¿Cuántas Instituciones Educativas/Universidades desea crear para el ambiente de desarrollo? \nPor defecto se crearán 10", 10);
            $educationalInstituteNum = !is_numeric($educationalInstituteNum) || $educationalInstituteNum <= 0 ? 10 : $educationalInstituteNum;
            $educationalInstitutes = \App\Models\EducationalInstitute::factory()->count($educationalInstituteNum)->make();

            $this->command->getOutput()->progressStart(count($educationalInstitutes));

            foreach ($educationalInstitutes as $academicDepartment) {
                sleep(1);
                $this->info("\n-Creando Institución Educativa/Universidad: '{$academicDepartment->name}'\n");
                $academicDepartment->save();
                $this->command->getOutput()->progressAdvance();
            }
            $this->command->getOutput()->progressFinish();
        } else {
            $this->warn("Este Seeder no está desarrollado para implementarse en un ambiente productivo.");
        }
    }
}
