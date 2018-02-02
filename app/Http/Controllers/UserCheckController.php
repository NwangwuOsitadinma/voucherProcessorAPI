<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckUserRequest;
use App\Services\UserCheckService;
use Illuminate\Http\Request;

class UserCheckController extends Controller
{
    protected $service;
    public function __construct(UserCheckService $s)
    {
        $this->service = $s;
    }

    public function getUserChecks()
    {
        return $this->service->getAll(10);
    }

    public function getUserCheck($id)
    {
        return $this->service->getById($id);
    }

    public function store(CheckUserRequest $request)
    {
        return $this->service->store($request);
    }

    public function update(CheckUserRequest $request, $id)
    {
        return $this->service->update($request,$id);
    }
    public function delete($id)
    {
        return $this->service->delete($id);
    }
}
