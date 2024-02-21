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

        // $this->call(UserSeeder::class);
        // $this->call(SkillsSeeder::class);
        // $this->call(LevelsSeeder::class);

        // $this->call(UserSeeder::class);
        $this->command->info('Database seeded successfully!');

    }
}
