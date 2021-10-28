<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnthropometriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anthropometries', function (Blueprint $table) {
            $table->id();
            $table->decimal('height');
            $table->decimal('height_difference');
            $table->decimal('weight');
            $table->decimal('weight_difference');
            $table->decimal('head_circumference');
            $table->decimal('head_circumference_difference');
            $table->decimal('bmi');
            $table->integer('month_periode');
            $table->integer('year_periode');
            $table->dateTime('visited_at');
            $table->foreignId('posyandu_id')->constrained('posyandu');
            $table->foreignId('height_for_age_category_id')->constrained('height_for_age_categories');
            $table->foreignId('weight_for_age_category_id')->constrained('weight_for_age_categories');
            $table->foreignId('weight_for_height_category_id')->constrained('weight_for_height_categories');
            $table->foreignId('bmi_for_age_category_id')->constrained('bmi_for_age_categories');
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
        Schema::dropIfExists('anthropometries');
    }
}
