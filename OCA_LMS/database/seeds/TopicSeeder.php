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
                'topic_name' => 'Emotional Design in UX',
                'technology_cohort_id' => '1',
            ],
            [
                'topic_name' => 'Responsive Design',
                'technology_cohort_id' => '1',
            ],
            [
                'topic_name' => 'HTML Global Attributes',
                'technology_cohort_id' => '8',
            ],
            [
                'topic_name' => 'Form Attributes',
                'technology_cohort_id' => '8',
            ],
            [
                'topic_name' => 'Flex & Grid',
                'technology_cohort_id' => '8',
            ],
            [
                'topic_name' => 'Api',
                'technology_cohort_id' => '2',
            ],
        ]);
    }
}
