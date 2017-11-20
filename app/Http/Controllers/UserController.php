<?php
/**
 * Created by PhpStorm.
 * User: Harrison Favour
 * Date: 17/11/2017
 * Time: 03:59 PM
 */

namespace App\Http\Controllers;


use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    private $service;

    public function __construct(UserService $userService)
    {
        $this->service = $userService;
    }

    public function getAllUsers()
    {
        return $this->service->getAll(5);
    }

    public function getById($id)
    {
        return $this->service->getById($id);
    }

    public function update($id, Request $request)
    {
        $required = [
            'firstName' => 'required',
            'lastName' => 'required',
            'emailAddress' => 'required',
            'password' => 'required',
            'sex' => 'required',
            'officeEntity' => 'required'
        ];
        $this->validate($request, $required);
        return $this->service->update($id, $request);
    }

    public function delete($id)
    {
        return $this->service->delete($id);
    }
}