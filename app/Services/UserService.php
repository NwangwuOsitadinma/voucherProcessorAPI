<?php
/**
 * Created by PhpStorm.
 * User: Harrison Favour
 * Date: 17/11/2017
 * Time: 03:50 PM
 */

namespace App\Services;


use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

use Illuminate\Support\Facades\Hash;

class UserService
{

    private $repository;
    private $rolesAndClaimsService;

    public function __construct(UserRepository $userRepository, RolesAndClaimsService $rolesAndClaimsService)
    {
        $this->repository = $userRepository;
        $this->rolesAndClaimsService = $rolesAndClaimsService;
    }

    public function getAll(int $n = null, array $fields = null)
    {
        return $this->repository->getAll($n, $fields);
    }

    public function getById($id)
    {
        return $this->repository->getById($id);
    }

    public function getByParam($param, $value)
    {
        return $this->repository->getByParam($param, $value);
    }

    public function create(UserRequest $request, $role)
    {
        if (!$this->repository->create($request->getAttributesArray())) {
            return response()->json(['message' => 'the resource was not created', 'data' => $request->getAttributesArray()], 500);
        }
        return $this->rolesAndClaimsService->assignRole($request->getAttributesArray(), $role) != null
            ? response()->json(['message' => 'the resource was successfully created', 'data' => $request->getAttributesArray()], 200)
            : response()->json(['message' => 'the user was created but the role was not set']);
    }

    public function updateUserRole($user, $newRole, $previousRole)
    {
        return $this->rolesAndClaimsService->retractUserRole($user, $previousRole)
            && $this->rolesAndClaimsService->assignRole($user, $newRole) != null;
    }

    public function update($id, UserRequest $request)
    {
        if (!$this->repository->update($id, $request->getAttributesArray())) {
            return response()->json(['message' => 'the resource was not updated', 'data' => $user], 500);
        }
        return response()->json(['message' => 'the resource was successfully updated', 'data' => $user], 200);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}