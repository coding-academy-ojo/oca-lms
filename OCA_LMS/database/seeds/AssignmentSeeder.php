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
                'assignment_name' => 'Create mockup & Wireframe',
                'assignment_description' => 'create mockup for your portfolio',
                'assignment_level' => 'easy',
                'assignment_due_date' => '2024-2-28',
                'assignment_attached_file' => '1708704922.pdf',
                'topic_id' => '1',
                'cohort_id' => '1',
                'trainer_id'=> '3',

            ],
            [
                'assignment_name' => 'Make full curd opration',
                'assignment_description' => 'create full curd opration for student in laravel and php myadmin sql',
                'assignment_level' => 'medium',
                'assignment_due_date' => '2024-2-28',
                'assignment_attached_file' => '1708704922.pdf',
                'topic_id' => '4',
                'cohort_id' => '1',
                'trainer_id'=> '3',

            ],
            [
                'assignment_name' => 'Implementing Fetch API in JavaScript',
                'assignment_description' => 'The task involves utilizing the Fetch API in JavaScript to make HTTP requests to servers and handle responses asynchronously. The Fetch API provides a more modern and powerful way to fetch resources from servers compared to older methods like XMLHttpRequest.',
                'assignment_level' => 'advance',
                'assignment_due_date' => '2024-2-28',
                'assignment_attached_file' => null,
                'topic_id' => '3',
                'cohort_id' => '1',
                'trainer_id'=> '3',
            ],
            [
                'assignment_name' => 'Creating static registration page ',
                'assignment_description' => '
                Assignment Description:
                
                Title: Creating a Static Registration Page
                
                Description:
                
                In this assignment, you will create a static registration page using HTML and CSS Your task is to design and implement a user-friendly registration form using HTML markup. The registration form should collect essential information from users, such as their name, email address, password, date of birth, etc. Additionally, you may include any other fields or features you deem relevant for the registration process.',
                'assignment_level' => 'advance',
                'assignment_due_date' => '2024-2-28',
                'assignment_attached_file' => null,
                'topic_id' => '4',
                'cohort_id' => '1',
                'trainer_id'=> '3',

            ],
            [
                'assignment_name' => 'create database ',
                'assignment_description' => 'In this assignment, you will be tasked with designing a database schema for an Assignment Management System (AMS). The AMS is a crucial component for educational institutions, facilitating the submission, tracking, and grading of assignments across various courses and classes. Your task is to create a well-structured database schema that can effectively manage assignments, students, instructors, courses, and grades.

                Here are the key components that your database schema should include:
                
                Students: Create a table to store student information such as student ID, name, email, and any other relevant details.
                
                Instructors: Design a table to store instructor details including instructor ID, name, email, and possibly department or subject expertise.
                
                Courses: Develop a table to store course information such as course ID, course name, instructor ID (foreign key), and any other relevant attributes.
                
                Assignments: Create a table to store assignment details including assignment ID, course ID (foreign key), assignment title, description, deadline, and any other necessary attributes.
                
                Submissions: Design a table to store submission information including submission ID, assignment ID (foreign key), student ID (foreign key), submission date, and any other relevant data..

                ',
                'assignment_level' => 'advance',
                'assignment_due_date' => '2024-2-28',
                'assignment_attached_file' =>'1708704922.pdf',
                'topic_id' => '6',
                'cohort_id' => '1',
                'trainer_id'=> '3',

            ],
            [
                'assignment_name' => 'create database ',
                'assignment_description' => 'In this assignment, you will be tasked with designing a database schema for an Assignment Management System (AMS). The AMS is a crucial component for educational institutions, facilitating the submission, tracking, and grading of assignments across various courses and classes. Your task is to create a well-structured database schema that can effectively manage assignments, students, instructors, courses, and grades.

                Here are the key components that your database schema should include:
                
                Students: Create a table to store student information such as student ID, name, email, and any other relevant details.
                
                Instructors: Design a table to store instructor details including instructor ID, name, email, and possibly department or subject expertise.
                
                Courses: Develop a table to store course information such as course ID, course name, instructor ID (foreign key), and any other relevant attributes.
                
                Assignments: Create a table to store assignment details including assignment ID, course ID (foreign key), assignment title, description, deadline, and any other necessary attributes.
                
                Submissions: Design a table to store submission information including submission ID, assignment ID (foreign key), student ID (foreign key), submission date, and any other relevant data..

                ',
                'assignment_level' => 'advance',
                'assignment_due_date' => '2024-2-28',
                'assignment_attached_file' =>'1708704922.pdf',
                'topic_id' => '4',
                'cohort_id' => '4',
                'trainer_id'=> '3',

            ],
            
            [
                'assignment_name' => 'Implementing Fetch API in JavaScript',
                'assignment_description' => 'The task involves utilizing the Fetch API in JavaScript to make HTTP requests to servers and handle responses asynchronously. The Fetch API provides a more modern and powerful way to fetch resources from servers compared to older methods like XMLHttpRequest.
                ',
                'assignment_level' => 'advance',
                'assignment_due_date' => '2024-2-28',
                'assignment_attached_file' => null,
                'topic_id' => '3',
                'cohort_id' => '4',
                'trainer_id'=> '3',

            ],
            [
                'assignment_name' => 'curd opration',
                'assignment_description' => 'create full curd opration for student in laravel and php myadmin sql',
                'assignment_level' => 'medium',
                'assignment_due_date' => '2024-2-28',
                'assignment_attached_file' => null,
                'topic_id' => '4',
                'cohort_id' => '4',
                'trainer_id'=> '3',

            ],
        ]);
    }
}
