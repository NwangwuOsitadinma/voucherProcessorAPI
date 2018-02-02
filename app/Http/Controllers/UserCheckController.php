<?php

namespace App\Http\Controllers;

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

    public function store(Request $request)
    {
        return $this->service->create();
    }

    public function update(Request $request, $id)
    {
        return $this->service->update();
    }
    public function delete()
    {
        return $this->service->delete();
    }
}
