<?php
/**
 * Created by PhpStorm.
 * User: Harrison Favour
 * Date: 23/11/2017
 * Time: 12:56 PM
 */

namespace App\Services;

use Silber\Bouncer\BouncerFacade as Bouncer;
// use Bouncer;

class RolesAndClaimsService {

    private $roleService;

    public function __construct()
    {
//        $this->roleService = new Bouncer();
    }

    public function newRoleWithClaims($role, array $claims)
    {
        return Bouncer::allow($role)->to($claims);
    }

    public function assignRole($user, $role)
    {
        return Bouncer::assign($role)->to($user);
    }

    public function confirmUserRole($user, $role)
    {
        return Bouncer::is($user)->a($role);
    }

    public function retractUserRole($user, $role)
    {
        return Bouncer::retract($role)->from($user);
    }

    public function retractUserClaims($user, array $claims)
    {
        return Bouncer::disallow($user)->to($claims);
    }

    public function retractRoleClaims($role, array $claims)
    {
        return Bouncer::disallow($role)->to($claims);
    }
}