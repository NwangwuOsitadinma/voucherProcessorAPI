<?php

/**
 * Created by PhpStorm.
 * User: Harrison Favour
 * Date: 21/01/2018
 * Time: 01:56 PM
 */

namespace App\Http\Controllers;

use App\Services\RolesAndClaimsService;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\RolesAndClaimsRequest;

class RolesAndClaimsController extends Controller
{

    public function __construct (RolesAndClaimsService $rolesAndClaimsService)
    {
        $this->rolesAndClaimsService = $rolesAndClaimsService;
    }

    public function getAllRoles()
    {
        return $this->rolesAndClaimsService->getAllRoles();
    }

    public function create(Request $request)
    {
        return $this->rolesAndClaimsService->createRoleWithClaims($request->role, $request->claims);
    }

    public function assignRole(Request $request)
    {
        $userDetails = $request->user;
        $user = new User();
        $user->setValues($userDetails['full_name'], $userDetails['email'], $userDetails['employee_id'], $userDetails['sex'], $userDetails['id']);
        $this->rolesAndClaimsService->assignRole($user, $request->role);
        return response()->json($this->rolesAndClaimsService->retractUserRole($user, $request->previousRole));
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