<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMonthsToHeightForAgeBoysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('height_for_age_boys', function (Blueprint $table) {
            $table->integer('months')->after('id');
        });

        Schema::table('height_for_age_girls', function (Blueprint $table) {
            $table->integer('months')->after('id');
        });

        Schema::table('weight_for_age_boys', function (Blueprint $table) {
            $table->integer('months')->after('id');
        });

        Schema::table('weight_for_age_girls', function (Blueprint $table) {
            $table->integer('months')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('height_for_age_boys', function (Blueprint $table) {
            //
        });
    }
}
