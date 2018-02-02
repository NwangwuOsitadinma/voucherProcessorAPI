<?php

use Illuminate\Database\Seeder;

class UserEmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_checks')->insert([[
            'email' => 'admin@tenece.com'
        ], [
            'email' => 'info@tenece.com'
        ], [
            'email' => 'contact@tenece.com'
        ]]);
    }
}
