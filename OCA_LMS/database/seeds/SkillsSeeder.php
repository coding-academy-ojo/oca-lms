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
            ['name' => 'Create mock-ups for an application'],
            ['name' => 'Create static and adaptive web user interfaces'],
            ['name' => 'Develop a dynamic web user interface'],
            ['name' => 'Create a user interface with a content management or e-commerce solution'],
            ['name' => 'Create a database'],
            ['name' => 'Develop data access components'],
            ['name' => 'Develop the back end of a web or mobile web application'],
            ['name' => 'content management or e-commerce application'],
            // Add more skills as needed
        ]);
    }
}
