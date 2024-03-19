<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('topics')->insert([
            [
                'topic_name' => 'curd opration',
                'technology_cohort_id' => '1',
            ],
            [
                'topic_name' => 'Api',
                'technology_cohort_id' => '3',
            ],
            [
                'topic_name' => 'Flex',
                'technology_cohort_id' => '2',
            ],
            [
                'topic_name' => 'Grid',
                'technology_cohort_id' => '2',
            ],
        ]);
    }
}
