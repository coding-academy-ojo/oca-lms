<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHoursSpentToMasterpieceTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * Adds a decimal hours_spent column (nullable, default 0.00).
     * Change the type/default as needed.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('masterpiece_tasks', function (Blueprint $table) {
            $table->integer('hours_spent')->unsigned()->default(0)->after('deadline')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('masterpiece_tasks', function (Blueprint $table) {
            $table->dropColumn('hours_spent');
        });
    }
}
