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
        foreach(range(1,1) as $index) {
            DB::table('departments')->insert([
                'name' => 'software'
            ]);
        }
    	foreach (range(1,3) as $index) {
	        DB::table('users')->insert([
	            'first_name' => $faker->name,
                'last_name' => $faker->lastName,
	            'email_address' => $faker->email,
	            'password' => Hash::make('password'),
                'sex' => $faker->word,
                'department_id' => 1
	        ]);
        }
    }
}
