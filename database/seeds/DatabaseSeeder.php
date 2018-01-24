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

        DB::table('branches')->insert([
            'name' => $faker->word,
            'location' => 'Enugu state',
            'description' => 'Enugu state head quarters'
        ]);

        DB::table('office_entity_types')->insert([
            'name' => 'department'
        ]);

        DB::table('office_entities')->insert([
            'name' => $faker->word,
            'branch_id' => 1,
            'office_entity_type_id' => 1
        ]);
        DB::table('users')->insert([
            'id' => 1,
            'full_name' => 'Harrison Favour',
            'email' => 'admin@tenece.com',
            'password' => Hash::make('password'),
            'employee_id' => '2C3ID',
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
