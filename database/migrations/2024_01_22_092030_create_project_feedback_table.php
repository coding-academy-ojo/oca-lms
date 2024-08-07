<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_feedback', function (Blueprint $table) {
            $table->id();

            $table->foreignId('staff_id')->constrained('staff');
            $table->foreignId('student_id')->constrained('students');
            $table->foreignId('submission_id')->constrained('project_submissions')->onDelete('cascade');
            $table->unsignedBigInteger('project_id');
            $table->text('feedback');
            $table->timestamps();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_feedback');
    }
}
