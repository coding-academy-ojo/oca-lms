<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('students') && Schema::hasColumn('students', 'face_photo')) {
            DB::statement('ALTER TABLE students MODIFY face_photo LONGTEXT NULL');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('students') && Schema::hasColumn('students', 'face_photo')) {
            DB::statement('ALTER TABLE students MODIFY face_photo VARCHAR(255) NULL');
        }
    }
};

