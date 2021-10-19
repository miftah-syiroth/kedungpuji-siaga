<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BabyConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('baby_conditions')->insert([
            ['condition' => 'Segera menangis'],
            ['condition' => 'Menangis beberapa saat'],
            ['condition' => 'Tidak menangis'],
            ['condition' => 'Seluruh tubuh kemerahan'],
            ['condition' => 'Anggota gerak kebiruan'],
            ['condition' => 'Seluruh tubuh biru'],
            ['condition' => 'Kelainan bawaan'],
            ['condition' => 'Meninggal'],
        ]);
    }
}
