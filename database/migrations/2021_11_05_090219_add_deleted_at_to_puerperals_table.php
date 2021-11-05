<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToPuerperalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('puerperals', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('puerperal_classes', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('pregnancies', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('prenatal_classes', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('puerperals', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('puerperal_classes', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('pregnancies', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });

        Schema::table('prenatal_classes', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
