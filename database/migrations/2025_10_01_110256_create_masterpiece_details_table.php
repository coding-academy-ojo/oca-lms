<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('masterpiece_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->string('project_sector');
            $table->string('project_name');
            $table->text('project_description')->nullable();
            $table->text('wireframe_mockup_link')->nullable();
            $table->text('presentation_link')->nullable();
            $table->text('documentation_link')->nullable();
            $table->text('github_link')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('masterpiece_details');
    }
};
