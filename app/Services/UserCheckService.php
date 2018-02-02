<?php
/**
 * Created by PhpStorm.
 * User: ositadinma_nwangwu
 * Date: 2/2/2018
 * Time: 9:38 AM
 */

namespace App\Services;


use App\Http\Requests\CheckUserRequest;
use App\Repositories\UserCheckRepository;

class UserCheckService
{
    protected $repository;

    public function __construct(UserCheckRepository $r)
    {
        $this->repository = $r;
    }

    public function getAll($n)
    {
        if(!$this->repository->getAll($n)){
            return response()->json(['message' => 'Something went wrong.']);
        }
        return $this->repository->getAll($n);
    }

    public function getById($id)
    {
        if(!$this->repository->getById($id)){
            return response()->json(['message' => 'The resource was not found']);
        }
        return $this->repository->getById($id);
    }

    public function store(CheckUserRequest $request)
    {
        if(!$this->repository->create($request->getAttributesArray())){
            return response()->json(['message' => 'Something went wrong. Please try again later']);
        }
        return response()->json(['message' => 'The user was created successfully']);
    }

    public function update(CheckUserRequest $request, $id)
    {
        if (!$this->repository->update($id, $request->getAttributesArray())){
            return response()->json(['message' => 'Something went wrong. Please try again']);
        }
        return response()->json(['message' => 'The user was updated successfully']);
    }

    public function delete($id)
    {
        if (!$this->repository->delete($id)){
            return response()->json(['message' => 'Something went wrong']);
        }
        return response()->json(['message' => 'The user was deleted successfully']);
    }
}