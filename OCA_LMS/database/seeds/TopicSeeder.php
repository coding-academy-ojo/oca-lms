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
                'technology_id' => '4',
            ],
            [
                'topic_name' => 'Api',
                'technology_id' => '4',
            ],
            [
                'topic_name' => 'Flex',
                'technology_id' => '2',
            ],
            [
                'topic_name' => 'Grid',
                'technology_id' => '2',
            ],
        ]);
    }
}
