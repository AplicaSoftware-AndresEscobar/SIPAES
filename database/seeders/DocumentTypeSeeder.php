<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Console\Concerns\InteractsWithIO;
use Symfony\Component\Console\Output\ConsoleOutput;

use App\Repositories\DocumentTypeRepository;

class DocumentTypeSeeder extends Seeder
{
    use InteractsWithIO;

    /** @var DocumentTypeRepository */
    protected $documentTypeRepository;

    public function __construct(DocumentTypeRepository $documentTypeRepository)
    {
        $this->documentTypeRepository = $documentTypeRepository;
        
        $this->output = new ConsoleOutput();
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $documentTypesArray = config('database.default-data.document_types');

        $this->command->getOutput()->progressStart(count($documentTypesArray));

        foreach ($documentTypesArray as $documentTypeItem) {
            $this->info("\n-Creando Tipo de Documentación: '{$documentTypeItem['name']}'\n");
            sleep(1);
            $this->documentTypeRepository->create($documentTypeItem);
            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();
    }
}
