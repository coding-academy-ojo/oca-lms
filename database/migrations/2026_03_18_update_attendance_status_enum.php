<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE attendances MODIFY COLUMN status ENUM('present', 'late', 'absent', 'excused', 'left_early', 'completed') DEFAULT 'absent'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE attendances MODIFY COLUMN status ENUM('present', 'late', 'absent', 'excused') DEFAULT 'absent'");
    }
};