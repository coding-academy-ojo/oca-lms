<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrainersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Sample data
        DB::table('trainers')->insert([
            'user_id' => 4, // Example user_id, assuming it's a valid user
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // You can add more entries here
    }
}
