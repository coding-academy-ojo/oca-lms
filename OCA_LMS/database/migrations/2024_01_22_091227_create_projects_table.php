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
            $table->string('name');
            $table->text('description');
            $table->date('start_date')->nullable();
            $table->date('delivery_date')->nullable();
            $table->string('image')->nullable();
            $table->unsignedBigInteger('cohort_id');
            $table->foreignId('staff_id')->constrained('staff')->nullable();
            $table->foreign('cohort_id')->references('id')->on('cohorts');
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
