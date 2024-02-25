<?php

use App\Academy;
use App\Assignment;
use App\Cohort;
use App\Student;
use App\Technology;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SkillsSeeder::class);
        $this->call(LevelsSeeder::class);
        $this->call(StaffTableSeeder::class);
        $this->call(TechnologyCategorySeeder::class);
        $this->call(TechnologySeeder::class);
        $this->call(SkillLevelsSeeder::class);
        $this->call(AcademyTableSeeder::class);
        $this->call(AcademyStaffTableSeeder::class,);
        $this->call(CohortsTableSeeder::class);
        $this->call(StudentsTableSeeder::class);
<<<<<<< HEAD
=======
        $this->call(TopicSeeder::class);
        $this->call(AssignmentSeeder::class);

>>>>>>> dd79eadf4531f9d114a35562bd3d3ae454f44060
        $this->command->info('Database seeded successfully!');
    }
}
