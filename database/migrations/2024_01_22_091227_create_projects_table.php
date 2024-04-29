<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->text('project_name');
            $table->text('project_description');
            $table->date('project_start_date')->nullable();
            $table->date('project_delivery_date')->nullable();
            $table->text('project_image')->nullable();
            $table->text('project_deliverable')->nullable();
            $table->text('project_resources')->nullable();
            $table->text('project_assessment_methods')->nullable();
            $table->unsignedBigInteger('cohort_id');
            $table->foreignId('staff_id')->constrained('staff')->nullable();
            $table->foreign('cohort_id')->references('id')->on('cohorts');
            $table->enum('project_type', ['Group', 'Individual', 'Corrective Action']);
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
        Schema::dropIfExists('projects');
    }
}
