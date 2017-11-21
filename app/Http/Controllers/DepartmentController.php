<?php
/**
 * Created by PhpStorm.
 * User: Harrison Favour
 * Date: 16/11/2017
 * Time: 11:49 AM
 */

namespace App\Http\Controllers;


use App\Services\DepartmentService;
use Symfony\Component\HttpFoundation\Request;

class DepartmentController extends Controller
{

    private $service;

    public function __construct(DepartmentService $departmentService)
    {
        $this->service = $departmentService;
    }

    public function getAll()
    {
        return $this->service->getAll(5);
    }

    public function getById($id)
    {
        return $this->service->getById($id);
    }

    public function create(Request $request)
    {
        $required = [
            'name' => 'required',
            'office_entity_type' => 'required'
        ];
        $this->validate($request, $required);
        return $this->service->create($request);
    }

    public function update($id, Request $request)
    {
        $required = [
            'name' => 'required',
            'office_entity_type' => 'required'
        ];
        $this->validate($request, $required);
        return $this->service->update($id, $request);
    }

    public function delete($id)
    {
        return $this->service->delete($id);
    }

}