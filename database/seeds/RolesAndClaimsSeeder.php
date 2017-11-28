<?php

use Illuminate\Database\Seeder;

class RolesAndClaimsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([[
            'id' => 1,
            'name' => 'Admin',
            'level' => 'Highest'
        ], [
            'id' => 2,
            'name' => 'Moderator',
            'level' => 'Medium'
        ], [
            'id' => 3,
            'name' => 'User',
            'level' => 'Lowest'
        ]]);
    }
}
