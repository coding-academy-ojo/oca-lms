<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Seed your skills here
         DB::table('skills')->insert([
            ['skills_name' => 'Create mock-ups for an application'],
            ['skills_name' => 'Create static and adaptive web user interfaces'],
            ['skills_name' => 'Develop a dynamic web user interface'],
            ['skills_name' => 'Create a user interface with a content management or e-commerce solution'],
            ['skills_name' => 'Create a database'],
            ['skills_name' => 'Develop data access components'],
            ['skills_name' => 'Develop the back end of a web or mobile web application'],
            ['skills_name' => 'content management or e-commerce application'],
            // Add more skills as needed
        ]);
    }
}
