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

    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

    public function getAll($n)
    {
        return $this->repository->getAll($n);
    }

    public function getById($id)
    {
        return $this->repository->getById($id);
    }

    public function getByParam($param, $value)
    {
        return $this->repository->getByParam($param, $value);
    }

    public function create(Request $request)
    {
        $user = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password
        ];
        if (!$this->repository->create($user)) {
            return response()->json(['message' => 'the resource was not created', 'data' => $user], 500);
        }
        return response()->json(['message' => 'the resource was successfully created', 'data' => $user], 200);
    }

    public function update($id, Request $request)
    {
        $user = [
            'first_name' => $request->firstName,
            'last_name' => $request->lastName,
            'email_address' => $request->emailAddress,
            'password' => $request->password,
            'sex' => $request->sex,
//            'department_id' => $request->department,
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