<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassroomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('picture');
            $table->unsignedBigInteger('academy_id');
            $table->unsignedBigInteger('manager_id');
            // $table->unsignedBigInteger('trainer_id');
            $table->foreign('academy_id')->references('id')->on('academies');
            $table->foreign('manager_id')->references('id')->on('users');
            // $table->foreign('trainer_id')->references('user_id')->on('trainers');
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
        Schema::dropIfExists('classrooms');
    }
}
