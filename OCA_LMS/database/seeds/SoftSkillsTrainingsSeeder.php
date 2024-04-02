<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SoftSkillsTrainingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('soft_skills_trainings')->insert([
            [
                'name' => 'Communication Skills Workshop',
                'description' => 'A workshop focused on improving verbal and non-verbal communication skills.',
                'trainer' => 'John Doe',
                'date' => '2024-03-01',
                'satisfaction' => 1, 
                'cohort_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Leadership Development Seminar',
                'description' => 'A seminar aimed at enhancing leadership qualities and strategies.',
                'trainer' => 'Jane Smith',
                'date' => '2024-03-15',
                'satisfaction' => 5,
                'cohort_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
