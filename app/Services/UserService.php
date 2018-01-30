<?php
/**
 * Created by PhpStorm.
 * User: Harrison Favour
 * Date: 17/11/2017
 * Time: 03:50 PM
 */

namespace App\Services;


use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;

use Auth;

class UserService
{

    private $repository;
    private $rolesAndClaimsService;

    public function __construct(UserRepository $userRepository, RolesAndClaimsService $rolesAndClaimsService)
    {
        $this->repository = $userRepository;
        $this->rolesAndClaimsService = $rolesAndClaimsService;
    }

    public function authenticate($email, $password, $rememberMe = false)
    {
        return Auth::attempt(['email' => $email, 'password' => $password], $rememberMe);
    }
    
    public function confirmUserDetails($email, $password)
    {
        $user = $this->repository->getOneByParam('email_address', $email);
        return $user && Hash::check($password, $user->password) ? $user : null;
    }

    public function create(UserRequest $request, $role)
    {
        $user = $this->repository->create($request->getAttributesArray());
        if (!$user) {
            return back()->withInput()->withErrors(['registerError' => 'user was not successfully registered']);
        }
        return $this->rolesAndClaimsService->assignRole($user, $role) != null
            ? $this->authenticate($request->email, $request->password) 
                ? redirect()->intended('/')
                : redirect('/login')
            : redirect('/login');
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
        if (!$this->repository->delete($id)) {
            return response()->json(['message' => 'the resource was not deleted']);
        }
        return response()->json(['message' => 'the resource was successfully deleted']);
    }

    public function getCategorizedEmployees($role)
    {
        return $this->repository->getCategorizedEmployees($role);
    }
}