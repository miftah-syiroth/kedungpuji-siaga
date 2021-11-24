<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnSexIdOnPregnanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pregnancies', function (Blueprint $table) {
            $table->dropColumn(['post_partum_condition', 'childbirth_order', 'baby_weight', 'baby_lenght', 'baby_head_circumference', 'baby_additional_information', 'childbirth_method']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pregnancies', function (Blueprint $table) {
            //
        });
    }
}
