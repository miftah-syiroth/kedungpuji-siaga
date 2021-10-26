<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeightForHeightBoysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('weight_for_height_boys', function (Blueprint $table) {
            $table->id();
            $table->decimal('height');
            $table->decimal('negative_3sd');
            $table->decimal('negative_2sd');
            $table->decimal('negative_1sd');
            $table->decimal('median');
            $table->decimal('positive_1sd');
            $table->decimal('positive_2sd');
            $table->decimal('positive_3sd');
        });

        Schema::create('weight_for_height_girls', function (Blueprint $table) {
            $table->id();
            $table->decimal('height');
            $table->decimal('negative_3sd');
            $table->decimal('negative_2sd');
            $table->decimal('negative_1sd');
            $table->decimal('median');
            $table->decimal('positive_1sd');
            $table->decimal('positive_2sd');
            $table->decimal('positive_3sd');
        });

        Schema::create('head_circumference_for_age_boys', function (Blueprint $table) {
            $table->id();
            $table->decimal('months');
            $table->decimal('negative_3sd');
            $table->decimal('negative_2sd');
            $table->decimal('negative_1sd');
            $table->decimal('median');
            $table->decimal('positive_1sd');
            $table->decimal('positive_2sd');
            $table->decimal('positive_3sd');
        });

        Schema::create('head_circumference_for_age_girls', function (Blueprint $table) {
            $table->id();
            $table->decimal('months');
            $table->decimal('negative_3sd');
            $table->decimal('negative_2sd');
            $table->decimal('negative_1sd');
            $table->decimal('median');
            $table->decimal('positive_1sd');
            $table->decimal('positive_2sd');
            $table->decimal('positive_3sd');
        });

        Schema::create('bmi_for_age_boys', function (Blueprint $table) {
            $table->id();
            $table->decimal('months');
            $table->decimal('negative_3sd');
            $table->decimal('negative_2sd');
            $table->decimal('negative_1sd');
            $table->decimal('median');
            $table->decimal('positive_1sd');
            $table->decimal('positive_2sd');
            $table->decimal('positive_3sd');
        });

        Schema::create('bmi_for_age_girls', function (Blueprint $table) {
            $table->id();
            $table->decimal('months');
            $table->decimal('negative_3sd');
            $table->decimal('negative_2sd');
            $table->decimal('negative_1sd');
            $table->decimal('median');
            $table->decimal('positive_1sd');
            $table->decimal('positive_2sd');
            $table->decimal('positive_3sd');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weight_for_height_boys');
        Schema::dropIfExists('weight_for_height_girls');
        Schema::dropIfExists('head_circumference_for_age_boys');
        Schema::dropIfExists('head_circumference_for_age_girls');
        Schema::dropIfExists('bmi_for_age_boys');
        Schema::dropIfExists('bmi_for_age_girls');
    }
}
