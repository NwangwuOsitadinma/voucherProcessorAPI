<?php
/**
 * Created by PhpStorm.
 * User: Harrison Favour
 * Date: 16/11/2017
 * Time: 11:49 AM
 */

namespace App\Http\Controllers;


use App\Services\DepartmentService;
use Illuminate\Http\Request;
use App\Http\Requests\DepartmentRequest;

class DepartmentController extends Controller
{

    private $service;

    public function __construct(DepartmentService $departmentService)
    {
        $this->service = $departmentService;
    }

    public function getAll(Request $request)
    {
        $n = $request->input('n') ?? null;
        $fields = $request->input('fields') ? explode(',', $request->input('fields')) : null;
        return $this->service->getAll($n, $fields);
    }

    public function getById($id)
    {
        return $this->service->getById($id);
    }

    public function create(DepartmentRequest $request)
    {
        return $this->service->create($request);
    }

    public function update($id, DepartmentRequest $request)
    {
        return $this->service->update($id, $request);
    }

    public function delete($id)
    {
        return $this->service->delete($id);
    }

}