<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNeonatusConclusionToPosyanduTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posyandu', function (Blueprint $table) {
            $table->text('neonatus_conclusion')->nullable();
            $table->text('posyandu_conclusion')->nullable();
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
            //
        });
    }
}
