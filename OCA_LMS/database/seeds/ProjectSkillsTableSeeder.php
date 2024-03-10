<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

         // Example data for project_skills table
         $projectSkills = [
            [
                'project_id' => 1,
                'skill_id' => 1,
                'level_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_id' => 2,
                'skill_id' => 1,
                'level_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'project_id' => 2,
                'skill_id' => 2,
                'level_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Insert data into the project_skills table
        DB::table('project_skills')->insert($projectSkills);
    }
}
