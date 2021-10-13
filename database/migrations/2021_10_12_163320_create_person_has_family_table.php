<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonHasFamilyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_has_family', function (Blueprint $table) {
            $table->foreignId('person_id')->nullable()->constrained('people');
            $table->foreignId('family_id')->nullable()->constrained('families');
            $table->foreignId('family_status_id')->nullable()->constrained('family_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('person_has_family');
    }
}
