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

    public function create(Request $request, $role)
    {
        $user = [
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'email_address' => $request->emailAddress,
            'password' => $request->password,
            'sex' => $request->sex,
            'office_entity_id' => $request->officeEntity
        ];
        if (!$this->repository->create($user)) {
            return response()->json(['message' => 'the resource was not created', 'data' => $user], 500);
        }
        return $this->rolesAndClaimsService->assignRole($user, $role) != null
            ? response()->json(['message' => 'the resource was successfully created', 'data' => $user], 200)
            : response()->json(['message' => 'the user was created but the role was not set']);
    }

    public function updateUserRole($user, $newRole, $previousRole)
    {
        return $this->rolesAndClaimsService->retractUserRole($user, $previousRole)
            && $this->rolesAndClaimsService->assignRole($user, $newRole)
            != null;
    }

    public function update($id, Request $request)
    {
        $user = [
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'email_address' => $request->emailAddress,
            'password' => $request->password,
            'sex' => $request->sex,
            'office_entity_id' => $request->officeEntity
        ];
        if (!$this->repository->update($id, $user)) {
            return response()->json(['message' => 'the resource was not updated', 'data' => $user], 500);
        }
        return response()->json(['message' => 'the resource was successfully updated', 'data' => $user], 200);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}