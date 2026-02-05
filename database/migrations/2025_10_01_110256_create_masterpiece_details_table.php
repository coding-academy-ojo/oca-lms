<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterpieceDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('masterpiece_details', function (Blueprint $table) {
            $table->id();

            // Foreign Keys
            $table->foreignId('student_id')
                ->constrained('students')
                ->onDelete('cascade');

            $table->foreignId('masterpiece_task_id')
                ->nullable()
                ->constrained('masterpiece_tasks')
                ->nullOnDelete();

            $table->foreignId('staff_id')
                ->nullable()
                ->constrained('staff')
                ->nullOnDelete();

            // Core fields
            $table->string('project_sector');
            $table->string('masterpiece_project_name')->nullable();
            $table->text('masterpiece_brief')->nullable();
            $table->string('masterpiece_wireframe_mockup_link')->nullable();
            $table->string('masterpiece_presentation_link')->nullable();
            $table->string('masterpiece_documentation_link')->nullable();
            $table->text('github_link')->nullable();
            $table->string('masterpiece_idea_link')->nullable();
            $table->string('masterpiece_frontend_link')->nullable();
            $table->string('masterpiece_full_version_link')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('masterpiece_details');
    }
}
