<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTechnologiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technologies', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
            $table->foreignId('technology_category_id')->constrained()->onDelete('cascade');
            $table->string('technologies_name');
            $table->text('technologies_description');
            $table->text('technologies_resources');
            $table->text('technologies_trainingPeriod');
            $table->string('technologies_photo')->nullable();
=======
            $table->string('name');
            $table->text('description');
            $table->text('resources');
            $table->text('training_period');
            $table->string('photo')->nullable();
>>>>>>> 2055cd74e82522a5e94017f5f3ff83829c00955c
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
        Schema::dropIfExists('technologies');
    }
}
