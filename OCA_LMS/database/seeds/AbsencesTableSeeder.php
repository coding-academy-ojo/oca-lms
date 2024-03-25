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

        // DB::table('absences')->insert([
        //     [
        //         'absences_type' => 'late',
        //         'absences_date' => '2024-03-24 10:01',
        //         'absences_reason'=>'had an interview',
        //         'absences_duration'=> '2 hour ',
        //         'student_id'=> 1,
        //     ],
        //     [
        //         'absences_type' => 'absent',
        //         'absences_date' => '2024-03-24 10:01',
        //         'absences_reason'=>'sick',
        //         'absences_duration'=> ' ',
        //         'student_id'=> 2,
        //     ],
        //     [
        //         'absences_type' => 'absent',
        //         'absences_date' => '2024-03-24 10:01',
        //         'absences_reason'=>'sick',
        //         'absences_duration'=> ' ',
        //         'student_id'=> 3,
        //     ],
        //     [
        //         'absences_type' => 'leaving',
        //         'absences_date' => '2024-03-24 10:01',
        //         'absences_reason'=>'doctor appointment',
        //         'absences_duration'=> ' ',
        //         'student_id'=> 4,
        //     ],
           
        // ]);
    }
}