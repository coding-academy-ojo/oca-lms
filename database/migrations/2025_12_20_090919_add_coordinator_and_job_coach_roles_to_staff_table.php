<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddCoordinatorAndJobCoachRolesToStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE staff MODIFY COLUMN role ENUM('manager', 'super_manager', 'trainer', 'coordinator', 'job_coach','auditer')");
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (DB::getDriverName() !== 'sqlite') {
            DB::statement("ALTER TABLE staff MODIFY COLUMN role ENUM('manager', 'super_manager', 'trainer', 'coordinator', 'job_coach', 'auditer')");
        }
    }
}
