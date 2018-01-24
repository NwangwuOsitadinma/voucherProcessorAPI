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

    public function index(Request $request)
    {
        $role = $request->user() ? base64_encode($request->user()->roles()->pluck('name')[0]) : null;
        setcookie('r', $role);
        return view('index', ['user' => $request->user()]);
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
