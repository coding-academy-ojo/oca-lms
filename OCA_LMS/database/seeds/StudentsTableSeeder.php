<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use App\Student;

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
        $academies = DB::table('academies')->pluck('id');
        $cohorts = DB::table('cohorts')->pluck('id');

        foreach (range(1, 10) as $index) {
            $academyId = $faker->randomElement($academies);
            $cohortId = $faker->randomElement($cohorts);

            DB::table('students')->insert([
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'), // Default password for all users
                'is_newsletter' => $faker->boolean,
                'provider_id' => $faker->randomNumber(),
                'email_verification' => $faker->boolean,
                'is_email_verified' => $faker->boolean,
                'mobile' => $faker->phoneNumber,
                'en_first_name' => $faker->firstName, // Generate a first name
                'en_last_name' => $faker->lastName, // Generate a last name
                'academy_id' => $academyId,
                'cohort_id' => $cohortId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}