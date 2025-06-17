<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class DefaultRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function getByUuid(string $uuid)
    {
        return $this->model->where('uuid', $uuid)->first();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $model = $this->getById($id);
        $model->update($data);

        return $model;
    }

    public function updateByUuid($uuid, array $data)
    {
        $model = $this->getByUuid($uuid);
        $model->update($data);

        return $model;
    }

    public function updateOrCreate(array $id, array $data)
    {
        return $this->model->updateOrCreate($id, $data);
    }

    public function delete($id)
    {
        $model = $this->getById($id);
        $model->delete();

        return $model;
    }
}
