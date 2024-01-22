<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_submissions', function (Blueprint $table) {
            $table->foreignId('project_id')->constrained();
            $table->foreignId('trainee_id')->constrained('trainees', 'user_id');
            $table->string('link');
            $table->text('text_submission');
            $table->timestamps();
        
            $table->primary(['project_id', 'trainee_id']);
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_submissions');
    }
}
