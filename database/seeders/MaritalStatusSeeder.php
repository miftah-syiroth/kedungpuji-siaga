<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaritalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('marital_statuses')->insert([
            ['status' => 'Belum Kawin'],
            ['status' => 'Kawin Tercatat'],
            ['status' => 'Kawin Belum Tercatat'],
            ['status' => 'Cerai Hidup Tercatat'],
            ['status' => 'Cerai Hidup Belum Tercatat'],
            ['status' => 'Cerai Mati'],
        ]);
    }
}
