<?php

use App\Academy;
use App\Assignment;
use App\Cohort;
use App\Student;
use App\Technology;
use App\Announcement;
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
        // $this->call(TechnologySeeder::class);
        $this->call(SkillLevelsSeeder::class);
        // $this->call(AcademyTableSeeder::class);
        // $this->call(AcademyStaffTableSeeder::class,);
        // $this->call(CohortsTableSeeder::class);
        // $this->call(StudentsTableSeeder::class);
        // $this->call(TechnologyCohortSeeder::class);
        // $this->call(TopicSeeder::class);
        // $this->call(AnnouncementSeeder::class);
        // $this->call(AbsencesTableSeeder::class);
        // $this->call(AssignmentSeeder::class);
        // $this->call(Assignment_StudentSeeder::class);
        // $this->call(Assignment_SubmissionsSeeder::class);
        // $this->call(MasterpieceTasksSeerder::class);
        // $this->call(MasterpieceProgressSeeder::class);

        // $this->call(StaffCohortTableSeeder::class);
        // $this->call(ProjectSeeder::class);
        // $this->call(ProjectSkillsTableSeeder::class);
        // $this->call(SoftSkillsTrainingsSeeder::class);

        $this->command->info('Database seeded successfully!');
    }
}
