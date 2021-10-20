<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNeonatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('neonatuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('posyandu_id')->constrained('posyandu');
            $table->text('condition')->nullable();
            $table->decimal('baby_weight');
            $table->decimal('baby_length');
            $table->decimal('baby_head_circumference');
            $table->boolean('is_imd');
            $table->boolean('is_vitamin_k1');
            $table->boolean('is_salep_mata');
            $table->timestamp('visited_at');
            $table->text('problem')->nullable();
            $table->string('referred to')->nullable();
            $table->string('health_worker');
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
        Schema::dropIfExists('neonatuses');
    }
}
