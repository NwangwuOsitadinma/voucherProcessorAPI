<?php

/**
 * Author: Harrison Grant
 * created on 05/11/2017
 **/

namespace App\Services;

use App\Repositories\ItemRepository;
use Illuminate\Http\Request;
use App\Http\Requests\ItemRequest;


class ItemService {
    protected $repository;

    public function __construct(ItemRepository $itemRepository)
    {
        $this->repository = $itemRepository;
    }

    public function getAll(int $n = null, array $fields = null)
    {
        $branches = $this->repository->getAll($n, $fields);
        return $branches
            ? $branches
            : response()->json(['message' => 'the resource you requested was not found']);
    }

    public function getById($id)
    {
        $item = $this->repository->getById($id);
        return $item
            ? $item
            : response()->json(['message' => 'the resource you requested was not found']);
    }

    public function create(array $item)
    {
        if (!$this->repository->create($item)) {
            return response()->json(['message' => 'the resource was not created', 'data' => $item], 500);
        }
        return response()->json(['message' => 'the resource was successfully created', 'data' => $item], 200);
    }

    public function update($id, ItemRequest $request)
    {
        if (!$this->repository->update($id, $request->getAttributesArray())) {
            return response()->json(['message' => 'the resource was not updated', 'data' => $request->getAttributesArray()], 500);
        }
        return response()->json(['message' => 'the resource was successfully updated', 'data' => $request->getAttributesArray()], 200);
    }

    public function delete($id)
    {
        if (!$this->repository->delete($id)) {
            return response()->json(['message' => 'the resource was not deleted']);
        }
        return response()->json(['message' => 'the resource was successfully deleted']);
    }

    public function getByParam($param, $value)
    {
        $item = $this->repository->getByParam($param, $value);
        return $item
            ?: response()->json(['message' => 'the resource you requested was not found']);
    }

    public function deleteByParam($param, $value)
    {
        if (!$this->repository->deleteByParam($param, $value)) {
            return response()->json(['message' => 'the resource was not deleted']);
        }
        return response()->json(['message' => 'the resource was successfully deleted']);
    }

}