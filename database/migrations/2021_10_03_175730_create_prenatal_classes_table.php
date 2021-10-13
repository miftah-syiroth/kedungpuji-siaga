<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrenatalClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prenatal_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pregnancy_id')->constrained('pregnancies');
            $table->decimal('mother_weight');
            $table->decimal('arm_circumference');
            $table->bigInteger('systolic');
            $table->bigInteger('diastolic');
            $table->decimal('uterine height');
            $table->bigInteger('baby_heart_rate');
            $table->bigInteger('hemoglobin');
            $table->foreignId('blood_group_id')->nullable()->constrained('blood_groups');
            $table->bigInteger('urine_protein');
            $table->bigInteger('blood_sugar');
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
        Schema::dropIfExists('prenatal_classes');
    }
}
