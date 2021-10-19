<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuerperalHasComplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puerperal_has_complications', function (Blueprint $table) {
            $table->foreignId('puerperal_complication_id')->constrained('puerperal_complications');
            $table->foreignId('puerperal_id')->constrained('puerperals');
        });

        Schema::create('puerperal_has_mother_conditions', function (Blueprint $table) {
            $table->foreignId('mother_condition_id')->constrained('mother_conditions');
            $table->foreignId('puerperal_id')->constrained('puerperals');
        });

        Schema::create('puerperal_has_baby_conditions', function (Blueprint $table) {
            $table->foreignId('baby_condition_id')->constrained('baby_conditions');
            $table->foreignId('puerperal_id')->constrained('puerperals');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('puerperal_has_complications');
        Schema::dropIfExists('puerperal_has_mother_conditions');
        Schema::dropIfExists('puerperal_has_baby_conditions');
    }
}
