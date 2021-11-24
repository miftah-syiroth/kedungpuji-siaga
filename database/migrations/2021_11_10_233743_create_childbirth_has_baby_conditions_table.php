<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildbirthHasBabyConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('childbirth_has_baby_conditions', function (Blueprint $table) {
            $table->foreignId('baby_condition_id')->constrained('baby_conditions');
            $table->foreignId('childbirth_id')->constrained('childbirths');
        });

        Schema::drop('pregnancy_has_baby_conditions');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('childbirth_has_baby_conditions');
    }
}
