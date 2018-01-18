<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Services\OfficeEntityService;

class Controller extends BaseController
{
    public function __construct(OfficeEntityService $officeEntityService)
    {
        $this->officeEntityService = $officeEntityService;
    }

    public function index()
    {
        return view('index');
    }

    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register', ['officeEntities' => $this->officeEntityService->getEntities()]);
    }
}
