<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePregnanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pregnancies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mother_id')->nullable()->constrained('people');
            $table->dateTime('hpht');
            $table->decimal('mother_weight');
            $table->decimal('mother_height');
            $table->decimal('mother_bmi')->nullable();
            $table->timestamp('childbirth_date')->nullable();
            $table->bigInteger('gestational_age')->nullable();
            $table->string('childbirth_attendant')->nullable();
            $table->string('post_partum_condition')->nullable();
            $table->foreignId('kb_status_id')->nullable()->constrained('kb_statuses');
            $table->bigInteger('childbirth_order')->nullable();
            $table->decimal('childbirth_weight')->nullable();
            $table->decimal('childbirth_length')->nullable();
            $table->decimal('baby_head_circumference')->nullable();
            $table->foreignId('baby_condition_id')->nullable()->constrained('baby_conditions');
            $table->string('other_baby_condition')->nullable();
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
        Schema::dropIfExists('pregnancies');
    }
}
