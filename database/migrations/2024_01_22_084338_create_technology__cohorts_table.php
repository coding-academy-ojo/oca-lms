<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechnologyCohortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technology__cohorts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('technology_id');
            $table->unsignedBigInteger('cohort_id')->nullable(); // Change to allow NULL values
            $table->text('start_date')->nullable();
            $table->text('end_date')->nullable();
            $table->timestamps();

            $table->foreign('technology_id')->references('id')->on('technologies');
            $table->foreign('cohort_id')->references('id')->on('cohorts'); // Change to set NULL on delete
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('technology__cohorts');
    }
}
