<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterpieceProgressTaskTable extends Migration

{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterpiece_progress_task', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('masterpiece_progress_id');
            $table->unsignedBigInteger('masterpiece_task_id');
            $table->timestamps();

            $table->foreign('masterpiece_progress_id')->references('id')->on('masterpiece_progress')->onDelete('cascade');
            $table->foreign('masterpiece_task_id')->references('id')->on('masterpiece_tasks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_masterpiece_progress_task');
    }
}
