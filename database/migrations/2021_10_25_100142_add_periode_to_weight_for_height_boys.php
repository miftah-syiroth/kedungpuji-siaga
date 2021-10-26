<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPeriodeToWeightForHeightBoys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('weight_for_height_boys', function (Blueprint $table) {
            $table->integer('periode')->after('id');
        });

        Schema::table('weight_for_height_girls', function (Blueprint $table) {
            $table->integer('periode')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('weight_for_height_boys', function (Blueprint $table) {
            //
        });

        Schema::table('weight_for_height_girls', function (Blueprint $table) {
            //
        });
    }
}
