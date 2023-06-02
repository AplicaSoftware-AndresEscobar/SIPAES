<?php

namespace Database\Seeders;

use Illuminate\Console\Concerns\InteractsWithIO;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Output\ConsoleOutput;

class CompanySeeder extends Seeder
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
            $companiesNum = (int)$this->command->ask("¿Cuántas Empresas/Compañías desea crear para el ambiente de desarrollo? \nPor defecto se crearán 10", 10);
            $companiesNum = !is_numeric($companiesNum) || $companiesNum <= 0 ? 10 : $companiesNum;
            $companies = \App\Models\Company::factory()->count($companiesNum)->make();

            $this->command->getOutput()->progressStart(count($companies));

            foreach ($companies as $company) {
                $this->info("\n-Creando Empresa/Compañía: '{$company->name}'\n");
                $company->save();
                $this->command->getOutput()->progressAdvance();
            }
            $this->command->getOutput()->progressFinish();
        } else {
            $this->warn("Este Seeder no está desarrollado para implementarse en un ambiente productivo.");
        }
    }
}
