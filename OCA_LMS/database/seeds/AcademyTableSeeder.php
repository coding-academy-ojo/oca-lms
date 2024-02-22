<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcademyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $academies = [
            ['academy_name' => 'Amman Academy', 'academy_location' => 'Amman'],
            ['academy_name' => 'Balqa Academy', 'academy_location' => 'Balqa'],
            ['academy_name' => 'Irbid Academy', 'academy_location' => 'Irbid'],
            ['academy_name' => 'Zarqa Academy', 'academy_location' => 'Zarqa'],
            ['academy_name' => 'Aqaba Academy', 'academy_location' => 'Aqaba'],
        ];

        DB::table('academies')->insert($academies);
    }
}
