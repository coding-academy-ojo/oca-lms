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
        // Retrieve all academies
        $academies = DB::table('academies')->get();

        $cohorts = [];
        foreach ($academies as $academy) {
            for ($i = 1; $i <= 3; $i++) {
                $cohorts[] = [
                    'cohort_name' => 'Cohort ' . $i . ' for ' . $academy->academy_name,
                    'cohort_description' => 'Description for Cohort ' . $i . ' of ' . $academy->academy_name,
                    'cohort_start_date' => date('Y-m-d', strtotime("2024-01-01 +$i months")),
                    'cohort_end_date' => date('Y-m-d', strtotime("2024-06-01 +$i months")),
                    'cohort_donor' => 'Donor ' . $i,
                    'academy_id' => $academy->id,
                ];
            }
        }

        // Insert cohorts into the database
        DB::table('cohorts')->insert($cohorts);
    }
}
