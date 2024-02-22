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
        $academies = DB::table('academies')->pluck('id'); // Get all academy IDs
        $cohorts = DB::table('cohorts')->pluck('id');

        foreach (range(1, 10) as $index) {
            $cohortId = $faker->randomElement($cohorts);
            $academyId = $faker->randomElement($academies);
            DB::table('students')->insert([
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password'), // You may want to hash passwords
                'is_newsletter' => $faker->boolean,
                'provider_id' => $faker->randomNumber(),
                'email_verification' => $faker->boolean,
                'is_email_verified' => $faker->boolean,
                'mobile' => $faker->phoneNumber,
                'academy_id' => $academyId,
                'cohort_id' => $cohortId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
