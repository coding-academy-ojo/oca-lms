<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AcademyStaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $academyIds = DB::table('academies')->pluck('id');
        $managerId = DB::table('staff')->where('role', 'manager')->value('id');
        $trainerId = DB::table('staff')->where('role', 'trainer')->value('id');
        $superManagerIds = DB::table('staff')->where('role', 'super_manager')->pluck('id');

        // Manager in one academy
        DB::table('academy_staff')->insert([
            'academy_id' => $academyIds[0], // Assuming the first academy for the manager
            'staff_id' => $managerId,
        ]);

        // Trainer in one academy
        DB::table('academy_staff')->insert([
            'academy_id' => $academyIds[0], // Assuming the first academy for the manager
            'staff_id' => $trainerId,
        ]);

        // Super Manager in all academies
        foreach ($academyIds as $academyId) {
            foreach ($superManagerIds as $superManagerId) {
                DB::table('academy_staff')->insert([
                    'academy_id' => $academyId,
                    'staff_id' => $superManagerId,
                ]);
            }
        }

    }
}
