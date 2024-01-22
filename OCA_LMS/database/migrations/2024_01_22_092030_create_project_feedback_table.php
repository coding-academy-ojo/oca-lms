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
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('trainee_id');
            $table->unsignedBigInteger('trainer_id');
            $table->text('feedback');
            $table->boolean('is_project_passed');
            $table->foreign('project_id')->references('id')->on('projects');
            $table->foreign('trainee_id')->references('user_id')->on('trainees');
            $table->foreign('trainer_id')->references('user_id')->on('trainers');
            $table->timestamps();
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
