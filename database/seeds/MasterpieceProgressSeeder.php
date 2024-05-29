<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class MasterpieceProgressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run()
    {
         // Make sure to disable foreign key checks to avoid issues with dependencies
         Schema::disableForeignKeyConstraints();
        
         // Truncate the table to start fresh
         DB::table('masterpiece_progress')->truncate();
 
         // Sample data
         $data = [
             [
                 'progress' => 50,
                 'staff_id' => 7,
                 'student_id' => 1,
                 'notes' => 'Initial feedback provided.',
                 'created_at' => Carbon::now(),
                 'updated_at' => Carbon::now(),
             ],
             [
                 'progress' => 70,
                 'staff_id' => 7,
                 'student_id' => 2,
                 'notes' => 'Halfway through the task.',
                 'created_at' => Carbon::now(),
                 'updated_at' => Carbon::now(),
             ],
             [
                 'progress' => 100,
                 'staff_id' => 7,
                 'student_id' => 3,
                 'notes' => ' completed successfully.',
                 'created_at' => Carbon::now(),
                 'updated_at' => Carbon::now(),
             ],
             [
                'progress' => 85,
                'staff_id' => 7,
                'student_id' => 5,
                'notes' => 'Almost finished, final touches remaining.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'progress' => 60,
                'staff_id' => 7,
                'student_id' => 4,
                'notes' => 'Not fully completed',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'progress' => 40,
                'staff_id' => 7,
                'student_id' => 2,
                'notes' => 'Research phase ongoing.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'progress' => 90,
                'staff_id' => 7,
                'student_id' => 3,
                'notes' => 'Final presentation preparation.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'progress' => 10,
                'staff_id' => 7,
                'student_id' => 4,
                'notes' => ' Idea confirmed ',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'progress' => 100,
                'staff_id' => 7,
                'student_id' => 2,
                'notes' => 'Project successfully completed and submitted.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
         ];
 
         // Insert data into the table
         DB::table('masterpiece_progress')->insert($data);
 
         // Re-enable foreign key checks
         Schema::enableForeignKeyConstraints();
     }
    }
