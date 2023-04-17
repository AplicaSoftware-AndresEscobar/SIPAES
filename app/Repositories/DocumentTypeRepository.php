<?php

namespace App\Repositories;

use App\Models\DocumentType;

class DocumentTypeRepository extends AbstractRepository
{
    public function __construct(DocumentType $model)
    {
        $this->model = $model;
    }
}
