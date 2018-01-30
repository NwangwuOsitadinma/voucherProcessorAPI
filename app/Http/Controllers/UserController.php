<?php
/**
 * Created by PhpStorm.
 * User: Harrison Favour
 * Date: 17/11/2017
 * Time: 03:59 PM
 */

namespace App\Http\Controllers;


use App\Services\UserService;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{

    private $service;

    public function __construct(UserService $userService)
    {
        $this->service = $userService;
    }

    public function login(Request $request)
    {
        if ($this->service->authenticate($request->email, $request->password)) {
            return redirect()->intended('/');
        } else {
            return back()->withInput()->withErrors(['loginError' => 'invalid username or password']);
        }
    }

    public function getAllUsers(Request $request)
    {
        $n = $request->input('n') ?: null;
        $fields = $request->input('fields') ? explode(',', $request->input('fields')) : null;
        return $this->service->getAll($n, $fields);
    }

    public function getById($id)
    {
        return $this->service->getById($id);
    }

    public function create(UserRequest $request)
    {
        return $this->service->create($request, 'USER');
    }

    public function update($id, UserRequest $request)
    {
        return $this->service->update($id, $request);
    }

    public function delete($id)
    {
        return $this->service->delete($id);
    }

    public function getCategorizedEmployees(Request $request)
    {
        return $this->service->getCategorizedEmployees($request->role);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}