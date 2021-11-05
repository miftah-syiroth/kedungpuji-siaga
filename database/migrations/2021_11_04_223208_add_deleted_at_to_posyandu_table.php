<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDeletedAtToPosyanduTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posyandu', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('neonatuses', function (Blueprint $table) {
            $table->softDeletes();
        });

        Schema::table('anthropometries', function (Blueprint $table) {
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
        Schema::table('posyandu', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('neonatuses', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
        Schema::table('anthropometries', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
}
