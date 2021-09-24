<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FamilyStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('family_statuses')->insert([
            ['status' => 'Kepala Keluarga'],
            ['status' => 'Suami'],
            ['status' => 'Istri'],
            ['status' => 'Anak'],
            ['status' => 'Menantu'],
            ['status' => 'Cucu'],
            ['status' => 'Orangtua'],
            ['status' => 'Mertua'],
            ['status' => 'Famili'],
            ['status' => 'Lainnya'],
        ]);
    }
}
