<?php
/**
 * Created by PhpStorm.
 * User: Harrison Favour
 * Date: 15/11/2017
 * Time: 04:48 PM
 */

namespace App\Services;


use App\Repositories\DepartmentRepository;
use Symfony\Component\HttpFoundation\Request;

class DepartmentService
{

    private $repository;

    public function __construct(DepartmentRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll($n)
    {
        return $this->repository->getAll($n);
    }

    public function getById($id)
    {
        return $this->repository->getById($id);
    }

    public function create(Request $request)
    {
        $department = [
            'name' => $request->name,
            'office_entity_type_id' => $request->office_entity_type
        ];
        if (!$this->repository->create($department)) {
            return response()->json(['message' => 'the resource was not created', 'data' => $department], 500);
        }
        return response()->json(['message' => 'the resource was successfully created', 'data' => $department], 200);
    }

    public function update($id, Request $request)
    {
        $department = [
            'name' => $request->name,
            'office_entity_type_id' => $request->office_entity_type
        ];
        if (!$this->repository->update($id, $department)) {
            return response()->json(['message' => 'the resource was not updated', 'data' => $department], 500);
        }
        return response()->json(['message' => 'the resource was successfully updated', 'data' => $department], 200);
    }

    public function delete($departmentId)
    {
        if (!$this->repository->delete($departmentId)) {
            return response()->json(['message' => 'the resource was not deleted']);
        }
        return response()->json(['message' => 'the resource was successfully deleted']);
    }

    public function getDepartmentOfficeEntityTypeId($departmentId)
    {
        $department = $this->repository->getByParam('id', $departmentId);
        return $department->office_entity_type_id;
    }

}