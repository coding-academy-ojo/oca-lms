<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class Assignment_SubmissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('assignment_submissions')->insert([
            [
                'is_late' => '0',
                'assignment_id' => '4',
                'attached_file' => 'https://github.com/coding-academy-ojo/oca-lmc/tree/main',
                'feedback' => 'modify submit button',
                'created_at' => '2024-2-28',
                'staff_id' => '3',
                'student_id' => '2',
            ],
            [
                'is_late' => '0',
                'assignment_id' => '4',
                'attached_file' => 'https://github.com/coding-academy-ojo/oca-lmc/tree/main',
                'feedback' => 'very good',
                'created_at' => '2024-3-3',
                'staff_id' => '3',
                'student_id' => '2',
            ],
            [
                'is_late' => '0',
                'assignment_id' => '5',
                'attached_file' => 'https://github.com/coding-academy-ojo/oca-lmc/tree/main',
                'feedback' => 'very good',
                'created_at' => '2024-3-3',
                'staff_id' => '3',
                'student_id' => '1',
            ],
        ]);
    }
}
