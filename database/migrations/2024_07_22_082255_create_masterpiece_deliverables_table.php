<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterpieceDeliverablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterpiece_deliverables', function (Blueprint $table) {
            $table->id();
            $table->string('masterpeice_project_name');
            $table->text('masterpiece_brief');
            $table->string('masterpiece_idea_link');
            $table->string('masterpiece_design_link');
            $table->string('masterpiece_mockup_link');
            $table->string('masterpiece_frontend_link');
            $table->string('masterpiece_full_version_link');
            $table->string('masterpiece_documents_link');
            $table->unsignedBigInteger('masterpiece_task_id');
            $table->foreign('masterpiece_task_id')->references('id')->on('masterpiece_tasks')->onDelete('cascade');
            $table->unsignedBigInteger('staff_id');
            $table->foreign('staff_id')->references('id')->on('staff')->onDelete('cascade');
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
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
        Schema::dropIfExists('masterpiece_deliverables');
    }
}
