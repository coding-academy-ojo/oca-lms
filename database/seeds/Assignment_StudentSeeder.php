<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class Assignment_StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('assignment_student')->insert([
            [
                'assignment_id' => '1',
                'student_id' => '1',
            ],
            [
                'assignment_id' => '1',
                'student_id' => '2',
            ],
            [
                'assignment_id' => '1',
                'student_id' => '3',
            ],
            [
                'assignment_id' => '4',
                'student_id' => '2',
            ],
            [
                'assignment_id' => '4',
                'student_id' => '5',
            ],
            [
                'assignment_id' => '4',
                'student_id' => '5',
            ],
            [
                'assignment_id' => '5',
                'student_id' => '1',
            ],
            [
                'assignment_id' => '5',
                'student_id' => '2',
            ],
            [
                'assignment_id' => '5',
                'student_id' => '3',
            ],
            [
                'assignment_id' => '5',
                'student_id' => '4',
            ],
            [
                'assignment_id' => '5',
                'student_id' => '5',
            ],

        ]);
    }
}
