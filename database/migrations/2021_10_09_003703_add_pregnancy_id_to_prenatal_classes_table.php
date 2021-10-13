<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPregnancyIdToPrenatalClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prenatal_classes', function (Blueprint $table) {
            $table->foreignId('pregnancy_id')->nullable()->constrained('pregnancies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prenatal_classes', function (Blueprint $table) {
            //
        });
    }
}
