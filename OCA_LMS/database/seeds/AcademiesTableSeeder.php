<?php

use Illuminate\Database\Seeder;
use App\Academy;

class AcademiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Academy::create([
            'name' => 'Balqa Academy ',
            'director' => 'Director 1',
            'super_director' => 'Super Director 1',
            'city' => 'Al salt',
        ]);

        Academy::create([
            'name' => 'Aqaba Academy',
            'director' => 'Director 2',
            'super_director' => 'Super Director 2',
            'city' => 'Al aqaba',
        ]);

        Academy::create([
            'name' => 'Amman academy',
            'director' => 'Director 3',
            'super_director' => 'Super Director 3',
            'city' => 'Amman',
        ]);
        Academy::create([
            'name' => 'Irbid academy',
            'director' => 'Director 3',
            'super_director' => 'Super Director 3',
            'city' => 'Irbid',
        ]);


        // Output a message to the console
        $this->command->info('Academies seeded successfully!');
    }
}
