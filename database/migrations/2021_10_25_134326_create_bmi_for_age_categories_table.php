<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBmiForAgeCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bmi_for_age_categories', function (Blueprint $table) {
            $table->id();
            $table->string('categories');
            $table->timestamps();
        });

        Schema::create('head_circumference_for_age_categories', function (Blueprint $table) {
            $table->id();
            $table->string('categories');
            $table->timestamps();
        });

        Schema::create('height_for_age_categories', function (Blueprint $table) {
            $table->id();
            $table->string('categories');
            $table->timestamps();
        });

        Schema::create('weight_for_age_categories', function (Blueprint $table) {
            $table->id();
            $table->string('categories');
            $table->timestamps();
        });

        Schema::create('weight_for_height_categories', function (Blueprint $table) {
            $table->id();
            $table->string('categories');
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
        Schema::dropIfExists('bmi_for_age_categories');
        Schema::dropIfExists('head_circumference_for_age_categories');
        Schema::dropIfExists('height_for_age_categories');
        Schema::dropIfExists('weight_for_age_categories');
        Schema::dropIfExists('weight_for_height_categories');
    }
}
