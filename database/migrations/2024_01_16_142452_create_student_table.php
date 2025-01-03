<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');
            $table->string('is_newsletter')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('email_verification')->nullable();
            $table->boolean('is_email_verified')->default(0);
            $table->string('mobile')->nullable();
            $table->string('mobile_verification')->nullable();
            $table->boolean('is_mobile_verified')->default(0);
            $table->tinyInteger('nationality')->nullable();
            $table->text('country')->nullable();
            $table->string('passport_number')->nullable();
            $table->unsignedBigInteger('national_id')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('en_first_name')->nullable();
            $table->string('en_second_name')->nullable();
            $table->string('en_third_name')->nullable();
            $table->string('en_last_name')->nullable();
            $table->string('ar_first_name')->nullable();
            $table->string('ar_second_name')->nullable();
            $table->string('ar_third_name')->nullable();
            $table->string('ar_last_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('martial_status')->nullable();
            $table->string('remember_token')->nullable();
            $table->string('education')->nullable();
            $table->string('educational_status')->nullable();
            $table->string('field')->nullable();
            $table->text('educational_background')->nullable();
            $table->string('ar_writing')->nullable();
            $table->string('ar_speaking')->nullable();
            $table->string('en_writing')->nullable();
            $table->string('en_speaking')->nullable();
            $table->string('city')->nullable();
            $table->text('address')->nullable();
            $table->unsignedBigInteger('relative_mobile_1')->nullable();
            $table->string('relative_relation_1')->nullable();
            $table->string('fullName_1')->nullable();
            $table->unsignedBigInteger('relative_mobile_2')->nullable();
            $table->string('relative_relation_2')->nullable();
            $table->string('fullName_2')->nullable();
            $table->string('is_committed')->nullable();
            $table->boolean('is_submitted')->default(0);
            $table->string('status')->nullable();
            $table->string('result_1')->nullable();
            $table->string('academy_location')->nullable();
            $table->string('id_img')->nullable();
            $table->string('personal_img')->nullable();
            $table->string('vaccination_img')->nullable();
            $table->string('eligible_to_move')->nullable();
            $table->string('github_link')->nullable();
            $table->string('linkedin_link')->nullable();
            $table->foreignId('academy_id')->constrained()->onDelete('cascade');
            $table->foreignId('cohort_id')->constrained()->onDelete('cascade');
            $table->string('certificate_type')->nullable();
            $table->boolean('internship_status')->default(0);
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->foreign('staff_id')->references('id')->on('staff')->onDelete('cascade');
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
        Schema::dropIfExists('student');
    }
}
