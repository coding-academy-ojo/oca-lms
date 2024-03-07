<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            $academyId = DB::table('academies')->inRandomOrder()->first()->id;
            
            $cohortId = DB::table('cohorts')->where('academy_id', $academyId)->inRandomOrder()->first()->id;

            DB::table('students')->insert([
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'),
                'is_newsletter' => $faker->boolean,
                'provider_id' => $faker->randomNumber(),
                'en_first_name' =>$faker->firstName(),
                'en_second_name' =>$faker->firstName(),
                'email_verification' => $faker->boolean,
                'is_email_verified' => $faker->boolean,
                'mobile' => $faker->phoneNumber,
                'en_first_name' => $faker->firstName, 
                'en_last_name' => $faker->lastName, 
                'academy_id' => $academyId,
                'cohort_id' => $cohortId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
