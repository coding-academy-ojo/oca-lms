<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Announcement; 

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        
    

        // Create dummy announcements
        foreach (range(1, 10) as $index) {
            Announcement::create([
                'content' => $faker->paragraph,
                'date' => $faker->date(),
                'staff_id' => 3,
                'cohort_id' => 2,
            ]);
        }

}
}
