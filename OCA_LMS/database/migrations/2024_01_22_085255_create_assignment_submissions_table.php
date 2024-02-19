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
        // $table->foreignId('trainee_id')->constrained('users')->where('role', 'trainee'); 
        $table->string('attached_file');
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
        Schema::dropIfExists('assignment_submissions');
    }
}
