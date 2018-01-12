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
        // foreach(range(1,1) as $index) {
        //     DB::table('departments')->insert([
        //         'name' => 'software'
        //     ]);
        // }

        DB::table('branches')->insert([
            'name' => $faker->word
        ]);

        DB::table('office_entity_types')->insert([
            'name' => 'department'
        ]);

        DB::table('office_entities')->insert([
            'name' => $faker->word,
            'branch_id' => 1,
            'office_entity_type_id' => 1
        ]);
    	foreach (range(1,3) as $index) {
	        DB::table('users')->insert([
	            'first_name' => $faker->name,
                'last_name' => $faker->lastName,
	            'email_address' => $faker->email,
                'password' => Hash::make('password'),
                'employee_id' => '343fdfd2',
                'sex' => $faker->word,
                'office_entity_id' => 1
	        ]);
        }
        $this->call(RolesAndClaimsSeeder::class);
    }
}
