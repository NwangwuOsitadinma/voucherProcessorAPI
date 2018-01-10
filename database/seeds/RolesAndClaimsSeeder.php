<?php

use Illuminate\Database\Seeder;
use Silber\Bouncer\Bouncer;
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
            $this->rolesAndClaimsService->newRoleWithClaims('admin', ['']);
            $this->rolesAndClaimsService->newRoleWithClaims('moderator', ['']);
            $this->rolesAndClaimsService->newRoleWithClaims('user', ['']);
        });
    }
}
