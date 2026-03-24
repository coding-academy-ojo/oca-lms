<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('academies', function (Blueprint $table) {
            $table->decimal('latitude', 10, 8)->nullable()->after('academy_location');
            $table->decimal('longitude', 11, 8)->nullable()->after('latitude');
            $table->integer('radius_meters')->default(100)->after('longitude')->comment('Geofence radius in meters');
        });
    }

    public function down(): void
    {
        Schema::table('academies', function (Blueprint $table) {
            $table->dropColumn(['latitude', 'longitude', 'radius_meters']);
        });
    }
};