<?php
/**
 * Created by PhpStorm.
 * User: Harris
 * Date: 05/11/2017
 * Time: 05:05 AM
 */

namespace App\Services;


use App\Repositories\BranchRepository;
use Illuminate\Http\Request;
use App\Http\Requests\BranchRequest;


class BranchService
{
    protected $repository;

    public function __construct(BranchRepository $branchRepository)
    {
        $this->repository = $branchRepository;
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
        $branch = $this->repository->getById($id);
        return $branch
            ? $branch
            : response()->json(['message' => 'the resource you requested was not found']);
    }

    public function create(BranchRequest $request)
    {
        if (!$this->repository->create($request->getAttributesArray())) {
            return response()->json(['message' => 'the resource was not created', 'data' => $request->getAttributesArray()], 500);
        }
        return response()->json(['message' => 'the resource was successfully created', 'data' => $request->getAttributesArray()], 200);
    }

    public function update($id, BranchRequest $request)
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

}