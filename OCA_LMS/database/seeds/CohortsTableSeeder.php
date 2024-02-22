<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CohortsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cohorts = [
            [
                'cohort_name' => 'Cohort 1',
                'cohort_description' => 'Description of Cohort 1',
                'cohort_start_date' => '2024-02-01',
                'cohort_end_date' => '2024-06-30',
                'cohort_donor' => 'Donor 1',
                'academy_id' => 1, // Replace with the actual ID of the associated academy
            ],
            [
                'cohort_name' => 'Cohort 2',
                'cohort_description' => 'Description of Cohort 2',
                'cohort_start_date' => '2024-03-01',
                'cohort_end_date' => '2024-07-31',
                'cohort_donor' => 'Donor 2',
                'academy_id' => 2, // Replace with the actual ID of the associated academy
            ],
        ];

        DB::table('cohorts')->insert($cohorts);
    }
}
