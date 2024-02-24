<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCohortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cohorts', function (Blueprint $table) {
            $table->id();
            $table->string('cohort_name');
            $table->text('cohort_description');
            $table->text('cohort_start_date');
            $table->text('cohort_end_date');
            $table->text('cohort_donor');
            $table->unsignedBigInteger('academy_id');
            $table->foreign('academy_id')->references('id')->on('academies');
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
        Schema::dropIfExists('cohorts');
    }
}
