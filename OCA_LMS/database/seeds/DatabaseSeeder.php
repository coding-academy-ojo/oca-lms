<?php

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
        $this->call(AcademyTableSeeder::class);
        $this->call(AcademyStaffTableSeeder::class,);
        $this->call(CohortsTableSeeder::class);
        $this->call(StudentsTableSeeder::class);
        $this->command->info('Database seeded successfully!');

    }
}
