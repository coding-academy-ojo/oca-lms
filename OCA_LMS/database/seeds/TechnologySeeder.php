<?php

use Illuminate\Database\Seeder;
use App\Technology;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Frontend Technologies
         Technology::create([
            'technology_category_id' => 1,
            'technologies_name' => 'UI/UX',
            'technologies_description' => 'Hypertext Markup Language',
            'technologies_resources' => 'https://www.google.com/',
            'technologies_trainingPeriod' => '2 weeks',
            'technologies_photo' => 'project.jpg',
        ]);

        Technology::create([
            'technology_category_id' => 1,
            'technologies_name' => 'HTML+CSS',
            'technologies_description' => 'Cascading Style Sheets',
            'technologies_resources' => 'https://www.google.com/',
            'technologies_trainingPeriod' => '3 weeks',
            'technologies_photo' => 'project.jpg',
        ]);

        Technology::create([
            'technology_category_id' => 1,
            'technologies_name' => 'JavaScript',
            'technologies_description' => 'A programming language',
            'technologies_resources' => 'https://www.google.com/',
            'technologies_trainingPeriod' => '4 weeks',
            'technologies_photo' => 'project.jpg',
        ]);

        // Backend Technologies
        Technology::create([
            'technology_category_id' => 2,
            'technologies_name' => 'PHP',
            'technologies_description' => 'A server-side scripting language',
            'technologies_resources' => 'https://www.google.com/',
            'technologies_trainingPeriod' => '5 weeks',
            'technologies_photo' => 'project.jpg',
        ]);

        Technology::create([
            'technology_category_id' => 2,
            'technologies_name' => 'Node.js',
            'technologies_description' => 'A JavaScript runtime environment',
            'technologies_resources' => 'https://www.google.com/',
            'technologies_trainingPeriod' => '6 weeks',
            'technologies_photo' => 'project.jpg',
        ]);

        Technology::create([
            'technology_category_id' => 2,
            'technologies_name' => '.net',
            'technologies_description' => 'A web application framework',
            'technologies_resources' => 'https://www.google.com/',
            'technologies_trainingPeriod' => '7 weeks',
            'technologies_photo' => 'project.jpg',
        ]);

        // Database Technologies
        Technology::create([
            'technology_category_id' => 3,
            'technologies_name' => 'MySQL',
            'technologies_description' => 'An open-source relational database management system',
            'technologies_resources' => 'https://www.google.com/',
            'technologies_trainingPeriod' => '8 weeks',
            'technologies_photo' => 'project.jpg',
        ]);

        Technology::create([
            'technology_category_id' => 3,
            'technologies_name' => 'MongoDB',
            'technologies_description' => 'A cross-platform document-oriented database program',
            'technologies_resources' => 'https://www.google.com/',
            'technologies_trainingPeriod' => '9 weeks',
            'technologies_photo' => 'project.jpg',
        ]);

        Technology::create([
            'technology_category_id' => 3,
            'technologies_name' => 'SQLServer',
            'technologies_description' => 'An advanced open-source relational database system',
            'technologies_resources' => 'https://www.google.com/',
            'technologies_trainingPeriod' => '10 weeks',
            'technologies_photo' => 'project.jpg',
        ]);
    }
}
