<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeightForAgeBoysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('height_for_age_boys', function (Blueprint $table) {
            $table->id();
            $table->decimal('negative_3sd');
            $table->decimal('negative_2sd');
            $table->decimal('negative_1sd');
            $table->decimal('median');
            $table->decimal('positive_1sd');
            $table->decimal('positive_2sd');
            $table->decimal('positive_3sd');
            $table->timestamps();
        });

        Schema::create('height_for_age_girls', function (Blueprint $table) {
            $table->id();
            $table->decimal('negative_3sd');
            $table->decimal('negative_2sd');
            $table->decimal('negative_1sd');
            $table->decimal('median');
            $table->decimal('positive_1sd');
            $table->decimal('positive_2sd');
            $table->decimal('positive_3sd');
            $table->timestamps();
        });

        Schema::create('weight_for_age_boys', function (Blueprint $table) {
            $table->id();
            $table->decimal('negative_3sd');
            $table->decimal('negative_2sd');
            $table->decimal('negative_1sd');
            $table->decimal('median');
            $table->decimal('positive_1sd');
            $table->decimal('positive_2sd');
            $table->decimal('positive_3sd');
            $table->timestamps();
        });

        Schema::create('weight_for_age_girls', function (Blueprint $table) {
            $table->id();
            $table->decimal('negative_3sd');
            $table->decimal('negative_2sd');
            $table->decimal('negative_1sd');
            $table->decimal('median');
            $table->decimal('positive_1sd');
            $table->decimal('positive_2sd');
            $table->decimal('positive_3sd');
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
        Schema::dropIfExists('height_for_age_boys');
        Schema::dropIfExists('height_for_age_girls');
        Schema::dropIfExists('weight_for_age_boys');
        Schema::dropIfExists('weight_for_age_girls');
    }
}
