<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class AssignmentSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('assignments')->insert([
            [
                'assignment_name' => 'create mockup',
                'assignment_description' => 'create mockup for your portfolio',
                'assignment_level' => 'easy',
                'assignment_due_date' => '2024-2-28',
                'assignment_attached_file' => null,
                'topic_id' => '1',
                'cohort_id' => '1',
            ],
            [
                'assignment_name' => 'curd opration',
                'assignment_description' => 'create full curd opration for student in laravel and php myadmin sql',
                'assignment_level' => 'medium',
                'assignment_due_date' => '2024-2-28',
                'assignment_attached_file' => null,
                'topic_id' => '4',
                'cohort_id' => '1',
            ],
            [
                'assignment_name' => 'Implementing Fetch API in JavaScript',
                'assignment_description' => 'The task involves utilizing the Fetch API in JavaScript to make HTTP requests to servers and handle responses asynchronously. The Fetch API provides a more modern and powerful way to fetch resources from servers compared to older methods like XMLHttpRequest.

                ',
                'assignment_level' => 'advance',
                'assignment_due_date' => '2024-2-28',
                'assignment_attached_file' => null,
                'topic_id' => '3',
                'cohort_id' => '1',
            ],
        ]);
    }
}
