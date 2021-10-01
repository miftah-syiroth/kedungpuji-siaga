<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoupleablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupleables', function (Blueprint $table) {
            $table->foreignId('couple_id')->constrained('couples');
            $table->unsignedBigInteger('coupleable_id');
            $table->string('coupleable_type');
            $table->bigInteger('year_periode');
            $table->bigInteger('month_periode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupleables');
    }
}
