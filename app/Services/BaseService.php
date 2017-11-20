<?php

/**
 * Author: Harrison Grant
 * created on 05/11/2017
 **/

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

abstract class BaseService
{

    protected $repository;

    public function getAll($n)
    {
        if (!$this->repository->getAll($n)) {
            return response()->json(['message' => 'the resource you requested was not found']);
        }
        return $this->repository->getAll($n);
    }

    public function getById($id)
    {
        if (!$this->repository->getById($id)) {
            return response()->json(['message' => 'the resource you requested was not found']);
        }
        return $this->repository->getById($id);
    }

    public function create(Model $model)
    {
        if (!$this->repository->create($model->attributesToArray())) {
            return response()->json(['message' => 'the resource was not created', 'data' => $model->attributesToArray()], 500);
        }
        return response()->json(['message' => 'the resource was successfully created', 'data' => $model->attributesToArray()], 200);
    }

    public function update($id, Model $model)
    {
        if (!$this->repository->update($id, $model->attributesToArray())) {
            return response()->json(['message' => 'the resource was not updated', 'data' => $model->attributesToArray()], 500);
        }
        return response()->json(['message' => 'the resource was successfully updated', 'data' => $model->attributesToArray()], 200);
    }

    public function delete($id)
    {
        if (!$this->repository->delete($id)) {
            return response()->json(['message' => 'the resource was not deleted']);
        }
        return response()->json(['message' => 'the resource was successfully deleted']);
    }


}