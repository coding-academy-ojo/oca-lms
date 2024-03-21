<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TechnologyCohortSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('technology__cohorts')->insert([
            [
                'cohort_id' => '1',
                'technology_id' => '1',
            ],
            [
                'cohort_id' => '1',
                'technology_id' => '4',
            ],
            [
                'cohort_id' => '1',
                'technology_id' => '7',
            ],
            [
                'cohort_id' => '1',
                'technology_id' => '5',
            ],
            [
                'cohort_id' => '4',
                'technology_id' => '1',
            ],
            [
                'cohort_id' => '4',
                'technology_id' => '3',
            ],
            [
                'cohort_id' => '4',
                'technology_id' => '6',
            ],
            [
                'cohort_id' => '1',
                'technology_id' => '2',
            ],
        ]);
    }
}
