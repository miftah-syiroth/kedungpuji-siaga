<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EducationalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('educationals')->insert([
            ['education' => 'Tidak/Belum Sekolah'],
            ['education' => 'Belum Taman SD/Sederajat'],
            ['education' => 'Tamat SD'],
            ['education' => 'SLTP/SMP/Sederajat'],
            ['education' => 'SLTA/SMA/Sederajat'],
            ['education' => 'Diploma I/II'],
            ['education' => 'Akademi/ Diploma III/ Sarjana Muda'],
            ['education' => 'Diploma IV/ Strata I/ Strata II'],
            ['education' => 'Strata III'],
            ['education' => 'Lainnya'],
        ]); 
    }
}
