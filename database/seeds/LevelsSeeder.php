<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('levels')->insert([
            ['levels_name' => 'Imitate'],
            ['levels_name' => 'Adapt'],
            ['levels_name' => 'Transpose'],
            // Add more levels as needed
        ]);
    }
}
