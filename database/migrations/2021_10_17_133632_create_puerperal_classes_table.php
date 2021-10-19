<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuerperalClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puerperal_classes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('puerperal_id')->constrained('puerperals');
            $table->dateTime('checked_at');
            $table->string('faskes');
            $table->text('problem')->nullable();
            $table->text('action')->nullable();
            $table->integer('periode');
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
        Schema::dropIfExists('puerperal_classes');
    }
}
