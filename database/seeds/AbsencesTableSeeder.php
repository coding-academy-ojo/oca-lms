<?php

use Illuminate\Database\Seeder;
use App\Absence;
use Illuminate\Support\Facades\DB;

class AbsencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 50 fake absences
        factory(Absence::class, 10)->create();

        DB::table('absences')->insert([
            [
                'absences_type' => 'late',
                'absences_date' => '2024-03-24 10:01',
                'absences_reason'=>'had an interview',
                'absences_duration'=> '2 hour ',
                'student_id'=> 1,
            ],
            [
                'absences_type' => 'absent',
                'absences_date' => '2024-03-24 10:01',
                'absences_reason'=>'sick',
                'absences_duration'=> ' ',
                'student_id'=> 2,
            ],
            [
                'absences_type' => 'absent',
                'absences_date' => '2024-03-24 10:01',
                'absences_reason'=>'sick',
                'absences_duration'=> ' ',
                'student_id'=> 3,
            ],
            [
                'absences_type' => 'leaving',
                'absences_date' => '2024-03-24 10:01',
                'absences_reason'=>'doctor appointment',
                'absences_duration'=> ' ',
                'student_id'=> 4,
            ],
            [
                'absences_type' => 'leaving',
                'absences_date' => '2024-04-5 03:00',
                'absences_reason'=>'doctor appointment',
                'absences_duration'=> ' ',
                'student_id'=> 5,
            ],
            [
                'absences_type' => 'absent',
                'absences_date' => '2024-04-5',
                'absences_reason'=>'sick',
                'absences_duration'=> ' ',
                'student_id'=> 7,
            ],
            [
                'absences_type' => 'absent',
                'absences_date' => '2024-04-5',
                'absences_reason'=>'Family Emergency',
                'absences_duration'=> ' ',
                'student_id'=> 8,
            ],
            [
                'absences_type' => 'late',
                'absences_date' => '2024-04-24 11:00',
                'absences_reason'=>'',
                'absences_duration'=> ' ',
                'student_id'=> 8,
            ],
            [
                'absences_type' => 'late',
                'absences_date' => '2024-03-24 10:01',
                'absences_reason'=>'had an interview',
                'absences_duration'=> '2 hour ',
                'student_id'=> 10,
            ],
            [
                'absences_type' => 'absent',
                'absences_date' => '2024-03-24 10:01',
                'absences_reason'=>'sick',
                'absences_duration'=> ' ',
                'student_id'=>11,
            ],
            [
                'absences_type' => 'absent',
                'absences_date' => '2024-03-24 10:01',
                'absences_reason'=>'sick',
                'absences_duration'=> ' ',
                'student_id'=> 12,
            ],
            [
                'absences_type' => 'leaving',
                'absences_date' => '2024-03-24 10:01',
                'absences_reason'=>'doctor appointment',
                'absences_duration'=> ' ',
                'student_id'=> 13,
            ],
            [
                'absences_type' => 'leaving',
                'absences_date' => '2024-04-5 03:00',
                'absences_reason'=>'doctor appointment',
                'absences_duration'=> ' ',
                'student_id'=> 9,
            ],
            [
                'absences_type' => 'absent',
                'absences_date' => '2024-04-5',
                'absences_reason'=>'sick',
                'absences_duration'=> ' ',
                'student_id'=> 10,
            ],
            [
                'absences_type' => 'absent',
                'absences_date' => '2024-04-5',
                'absences_reason'=>'Family Emergency',
                'absences_duration'=> ' ',
                'student_id'=> 11,
            ],
        

           
        ]);
    }
}