<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
        $faker = Faker::create();

        DB::table('branches')->insert([[
            'name' => 'Enugu branch',
            'location' => 'Km 7, Enugu/ Port Harcourt Expressway, Enugu state',
            'description' => 'Enugu state head quarters'
        ], [
            'name' => 'Lagos branch',
            'location' => 'Ligali Ayorinde, Victoria Island, Lagos state',
            'description' => 'Lagos state head quarters'
        ] 
        ]);

        DB::table('office_entity_types')->insert([
            'name' => 'department',
            'description' => 'departments are the major unit types'
        ]);

        DB::table('office_entities')->insert([
            'name' => 'Software',
            'branch_id' => 1,
            'office_entity_type_id' => 1,
            'description' => 'this deprartment controls the software operations in Tenece'
        ], [
            'name' => 'OPS',
            'branch_id' => 2,
            'office_entity_type_id' => 1,
            'description' => 'this deprartment controls the general operations in Tenece'
        ]);
        DB::table('users')->insert([
            'id' => 1,
            'full_name' => 'Harrison Favour',
            'email' => 'admin@tenece.com',
            'password' => Hash::make('password'),
            'employee_id' => 'TC231732X',
            'sex' => 'MALE'
        ]);
    	// foreach (range(1,3) as $index) {
	    //     DB::table('users')->insert([
	    //         'full_name' => $faker->lastName,
	    //         'email_address' => $faker->email,
        //         'password' => Hash::make('password'),
        //         'employee_id' => $faker->word,
        //         'sex' => $faker->word
        //         // 'office_entity_id' => 1
	    //     ]);
        // }
        $this->call(RolesAndClaimsSeeder::class);
    }
}
