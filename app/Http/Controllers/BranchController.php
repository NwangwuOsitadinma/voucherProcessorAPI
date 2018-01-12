<?php
/**
 * Created by PhpStorm.
 * User: Harris
 * Date: 05/11/2017
 * Time: 05:11 AM
 */


namespace App\Http\Controllers;


use App\Services\BranchService;
use Illuminate\Http\Request;
use App\Http\Requests\BranchRequest;

class BranchController extends Controller
{

    protected $service;

    public function __construct(BranchService $branchService)
    {
        $this->service = $branchService;
    }

    public function getAllBranches(Request $request)
    {
        $n = $request->input('n') ?? null;
        $fields = $request->input('fields') ? explode(',', $request->input('fields')) : null;
        return $this->service->getAll($n, $fields);
    }

    public function getById($id)
    {
        return $this->service->getById($id);
    }

    public function create(BranchRequest $request)
    {
        return $this->service->create($request);
    }

    public function update($id, BranchRequest $request)
    {
        return $this->service->update($id, $request);
    }

    public function delete($id)
    {
        return $this->service->delete($id);
    }

}