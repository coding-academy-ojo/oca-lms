<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffCohortTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('staff_cohort')->insert([
            [
                'staff_id' => 1,
                'cohort_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'staff_id' => 3,
                'cohort_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'staff_id' => 7,
                'cohort_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'staff_id' => 4,
                'cohort_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'staff_id' => 5,
                'cohort_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'staff_id' => 8,
                'cohort_id' => 13,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}
