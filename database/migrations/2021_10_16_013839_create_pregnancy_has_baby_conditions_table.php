<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePregnancyHasBabyConditionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pregnancy_has_baby_condition', function (Blueprint $table) {
            $table->foreignId('baby_condition_id')->constrained('baby_conditions');
            $table->foreignId('pregnancy_id')->constrained('pregnancies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pregnancy_has_baby_condition');
    }
}
