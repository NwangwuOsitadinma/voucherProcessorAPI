<?php

use Illuminate\Database\Seeder;
use Silber\Bouncer\BouncerFacade as Bouncer;
use App\Services\RolesAndClaimsService;
use App\Services\UserService;

class RolesAndClaimsSeeder extends Seeder
{
    private $rolesAndClaimsService;

    public function __construct(RolesAndClaimsService $rolesAndClaimsService, UserService $userService)
    {
        $this->rolesAndClaimsService = $rolesAndClaimsService;
        $this->userService = $userService;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = $this->userService->getById(1);
        Bouncer::seeder(function() use ($user) {
            $this->rolesAndClaimsService->createRoleWithClaims('ADMIN', ['create-branch', 'view-branches', 'edit-branch', 
            'delete-branch', 'create-office-entity', 'view-office-entities', 'edit-office-entity', 'delete-office-entity', 
            'create-office-entity-type', 'view-office-entity-types', 'edit-office-entity-type', 'delete-office-entity-type', 
            'create-voucher', 'view-vouchers', 'edit-voucher', 'delete-voucher', 'approve-voucher', 'create-item', 'view-items', 'edit-items', 'delete-items', 'delete-user']);
            $this->rolesAndClaimsService->createRoleWithClaims('MODERATOR', ['create-office-entity', 'view-office-entities', 'edit-office-entity', 'delete-office-entity', 
            'create-voucher', 'view-vouchers', 'edit-voucher', 'delete-voucher', 'approve-voucher', 'create-item', 'view-items', 'edit-items', 'delete-items']);
            $this->rolesAndClaimsService->createRoleWithClaims('USER', ['create-voucher', 'view-vouchers', 'edit-voucher', 'delete-voucher', 'create-item', 'view-items', 'edit-items', 'delete-items']);
            $this->rolesAndClaimsService->assignRole($user, 'ADMIN');
        });
        Bouncer::seed();
    }
}
