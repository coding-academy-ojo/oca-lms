<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

public function up()
{
    Schema::create('assignment_submissions', function (Blueprint $table) {
        $table->id();
        $table->boolean('is_late')->default(0);
        $table->foreignId('assignment_id')->constrained('assignments');
        $table->string('attached_file');
        $table->text('feedback')->nullable();
        $table->text('status')->default('not pass');
        $table->unsignedBigInteger('staff_id')->nullable();
        $table->foreign('staff_id')->references('id')->on('staff')->onDelete('cascade');
        $table->unsignedBigInteger('student_id');
        $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        $table->timestamps();
        $table->softDeletes();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assignment_submissions');
    }
}
