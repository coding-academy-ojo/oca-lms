<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignment_feedback', function (Blueprint $table) {
            $table->foreignId('assignment_submission_id')->constrained('assignment_submissions');
            $table->foreignId('trainer_id')->constrained('trainers', 'user_id');
            $table->text('feedback');
            $table->timestamps();
        
            $table->primary(['assignment_submission_id', 'trainer_id']);
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignment_feedback');
    }
}
