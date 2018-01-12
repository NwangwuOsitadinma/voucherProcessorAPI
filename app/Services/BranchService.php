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

    public function create(Request $request)
    {
        $branch = ['name' => $request->name,
            'finance_head_id' => $request->finance_head,
            'payer_id' => $request->payer,
            'location' => $request->location,
            'description' => $request->description
        ];
        if (!$this->repository->create($branch)) {
            return response()->json(['message' => 'the resource was not created', 'data' => $branch], 500);
        }
        return response()->json(['message' => 'the resource was successfully created', 'data' => $branch], 200);
    }

    public function update($id, Request $request)
    {
        $branch = ['name' => $request->name,
            'finance_head_id' => $request->finance_head,
            'payer_id' => $request->payer
        ];
        if (!$this->repository->update($id, $branch)) {
            return response()->json(['message' => 'the resource was not updated', 'data' => $branch], 500);
        }
        return response()->json(['message' => 'the resource was successfully updated', 'data' => $branch], 200);
    }

    public function delete($id)
    {
        if (!$this->repository->delete($id)) {
            return response()->json(['message' => 'the resource was not deleted']);
        }
        return response()->json(['message' => 'the resource was successfully deleted']);
    }

}