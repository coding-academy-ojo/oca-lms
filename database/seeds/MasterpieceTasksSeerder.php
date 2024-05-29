<?php

use Illuminate\Database\Seeder;

class MasterpieceTasksSeerder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('masterpiece_tasks')->insert([
            ['task_name' => 'Idea Pitching', 'deadline' => '2024-2-28'],
            ['task_name' => 'Wireframe & Mockup', 'deadline' => '2024-2-28'],
            ['task_name' => 'Front-end' , 'deadline' => '2024-2-28'],
            ['task_name' => 'Final version fully functional' , 'deadline' => '2024-2-28'],
            ['task_name' => 'All other deliverables' , 'deadline' => '2024-2-28']
            
        ]); 
    }
}
