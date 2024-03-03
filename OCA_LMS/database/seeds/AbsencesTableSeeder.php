<?php

use Illuminate\Database\Seeder;
use App\Absence;

class AbsencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create 50 fake absences
        factory(Absence::class, 10)->create();
    }
}