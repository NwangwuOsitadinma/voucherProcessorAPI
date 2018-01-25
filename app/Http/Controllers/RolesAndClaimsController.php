<?php

/**
 * Created by PhpStorm.
 * User: Harrison Favour
 * Date: 21/01/2018
 * Time: 01:56 PM
 */

namespace App\Http\Controllers;

use App\Services\RolesAndClaimsService;
use Illuminate\Http\Request;
use App\Http\Requests\RolesAndClaimsRequest;

class RolesAndClaimsController extends Controller
{

    public function __construct (RolesAndClaimsService $rolesAndClaimsService)
    {
        $this->rolesAndClaimsService = $rolesAndClaimsService;
    }

    public function create(Request $request)
    {
        return $this->rolesAndClaimsService->createRoleWithClaims($request->role, $request->claims);
    }

    public function assignRole(Request $request)
    {
        return $this->rolesAndClaimsService->assignRole($request->user, $request->role);
    }

    public function confirmUserRole(Request $request)
    {
        return $this->rolesAndClaimsService->confirmUserRole($request->user(), $request->role);
    }

    public function retractUserRole(Request $request)
    {
        return $this->rolesAndClaimsService->retractUserRole($request->user, $request->role);
    }

    public function retractUserClaims(Request $request)
    {
        return $this->rolesAndClaimsService->retractUserClaims($request->user, $request->claims);
    }

    public function retractRoleClaims(Request $request)
    {
        return $this->rolesAndClaimsService->retractRoleClaims($request->role, $request->claims);
    }

}