<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('family_id')->nullable()->constrained('families');
            $table->foreignId('family_status_id')->constrained('family_statuses');
            $table->foreignId('sex_id')->constrained('sexes');
            $table->foreignId('blood_group_id')->nullable()->constrained('blood_groups');
            $table->foreignId('religion_id')->constrained('religions');
            $table->foreignId('marital_status_id')->constrained('marital_statuses');
            $table->foreignId('ibu_id')->nullable()->constrained('people');
            $table->foreignId('ayah_id')->nullable()->constrained('people');
            $table->foreignId('disability_id')->nullable()->constrained('disabilities');
            $table->foreignId('educational_id')->constrained('educationals');
            $table->string('name');
            $table->string('place_of_birth');
            $table->dateTime('date_of_birth');
            $table->integer('RW');
            $table->integer('RT');
            $table->boolean('is_cacat');
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
        Schema::dropIfExists('people');
    }
}
