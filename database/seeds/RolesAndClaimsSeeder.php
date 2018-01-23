<?php

use Illuminate\Database\Seeder;
use Silber\Bouncer\BouncerFacade as Bouncer;
use App\Services\RolesAndClaimsService;

class RolesAndClaimsSeeder extends Seeder
{
    private $rolesAndClaimsService;

    public function __construct(RolesAndClaimsService $rolesAndClaimsService)
    {
        $this->rolesAndClaimsService = $rolesAndClaimsService;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bouncer::seeder(function() {
            $this->rolesAndClaimsService->createRoleWithClaims('admin', ['create-branch', 'view-branches', 'edit-branch', 
            'delete-branch', 'create-office-entity', 'view-office-entities', 'edit-office-entity', 'delete-office-entity', 
            'create-office-entity-type', 'view-office-entity-types', 'edit-office-entity-type', 'delete-office-entity-type', 
            'create-voucher', 'view-vouchers', 'edit-voucher', 'delete-voucher', 'approve-voucher', 'create-item', 'view-items', 'edit-items', 'delete-items']);
            $this->rolesAndClaimsService->createRoleWithClaims('moderator', ['create-office-entity', 'view-office-entities', 'edit-office-entity', 'delete-office-entity', 
            'create-voucher', 'view-vouchers', 'edit-voucher', 'delete-voucher', 'approve-voucher', 'create-item', 'view-items', 'edit-items', 'delete-items']);
            $this->rolesAndClaimsService->createRoleWithClaims('user', ['create-voucher', 'view-vouchers', 'edit-voucher', 'delete-voucher', 'approve-voucher', 'create-item', 'view-items', 'edit-items', 'delete-items']);
        });
        Bouncer::seed();
    }
}
