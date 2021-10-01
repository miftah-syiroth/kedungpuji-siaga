<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeluargaBerencanaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keluarga_berencana', function (Blueprint $table) {
            $table->id();
            $table->foreignId('couple_id')->nullable()->constrained('couples');
            $table->unsignedBigInteger('kbable_id');
            $table->string('kbable_type');
            $table->bigInteger('year_periode');
            $table->bigInteger('month_periode');
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
        Schema::dropIfExists('keluarga_berencana');
    }
}
