<?php

/**
 * Author: Harrison Grant
 * created on 05/11/2017
 **/

namespace App\Services;

use App\Repositories\ItemRepository;
use Illuminate\Http\Request;


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

    public function create(Request $request)
    {
        $item = ['name' => $request->name,
            'price' => $request->price,
            'voucher_id' => $request->voucher
        ];
        if (!$this->repository->create($item)) {
            return response()->json(['message' => 'the resource was not created', 'data' => $item], 500);
        }
        return response()->json(['message' => 'the resource was successfully created', 'data' => $item], 200);
    }

    public function update($id, Request $request)
    {
        $item = ['name' => $request->name,
            'price' => $request->price,
            'voucher_id' => $request->voucher
        ];
        if (!$this->repository->update($id, $item)) {
            return response()->json(['message' => 'the resource was not updated', 'data' => $item], 500);
        }
        return response()->json(['message' => 'the resource was successfully updated', 'data' => $item], 200);
    }

    public function delete($id)
    {
        if (!$this->repository->delete($id)) {
            return response()->json(['message' => 'the resource was not deleted']);
        }
        return response()->json(['message' => 'the resource was successfully deleted']);
    }

}