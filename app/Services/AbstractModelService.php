<?php

namespace App\Services;

use App\Repositories\AbstractRepository;

abstract class AbstractModelService
{
    /** @var AbstractRepository */
    protected $baseRepository;

    /**
     * Store a new resource.
     * 
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function save(array $data)
    {
        return $this->baseRepository->create($data);
    }

    /**
     * Update a resource.
     * 
     * @param array $data
     * @param mixed $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update(array $data, mixed $id)
    {
        $item = $this->baseRepository->getById($id);
        $this->baseRepository->update($item, $data);
        return $item;
    }

    /**
     * Delete a resource.
     * 
     * @param mixed $id
     */
    public function delete(mixed $id)
    {
        $item = $this->baseRepository->getById($id);
        $this->baseRepository->delete($item);
    }
}
