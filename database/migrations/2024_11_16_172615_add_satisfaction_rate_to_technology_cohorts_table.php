<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSatisfactionRateToTechnologyCohortsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('technology__cohorts', function (Blueprint $table) {
            $table->unsignedDecimal('satisfaction_rate', 5, 2)->nullable()->after('end_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('technology__cohorts', function (Blueprint $table) {
            $table->dropColumn('satisfaction_rate');
        });
    }
}
