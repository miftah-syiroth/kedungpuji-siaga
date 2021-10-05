<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBabyConditionIdOnPregnantWomenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pregnant_women', function (Blueprint $table) {
            $table->foreignId('baby_condition_id')->nullable()->constrained('baby_conditions')->after('baby_head_circumference');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pregnant_women', function (Blueprint $table) {
            //
        });
    }
}
