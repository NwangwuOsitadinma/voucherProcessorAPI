<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OfficeEntityService;

class MainController extends Controller
{
    
    public function __construct(OfficeEntityService $officeEntityService)
    {
        $this->officeEntityService = $officeEntityService;
    }

    public function index()
    {
        return view('index');
    }

    public function loginPage()
    {
        return view('login');
    }

    public function registerPage()
    {
        return view('register', ['officeEntities' => $this->officeEntityService->getEntities()]);
    }
}
