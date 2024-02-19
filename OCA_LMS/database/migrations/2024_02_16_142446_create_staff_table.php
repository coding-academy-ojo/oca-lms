<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();

            $table->string('staff_name');
            $table->string('staff_email')->unique();
            $table->string('staff_password');
            $table->enum('role', ['manager', 'super_manager', 'trainer']);
            $table->text('staff_cv')->nullable();
            $table->text('staff_bio')->nullable();
            $table->string('staff_personal_img')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staff');
    }
}
