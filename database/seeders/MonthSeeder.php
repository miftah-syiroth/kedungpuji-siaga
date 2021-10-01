<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('months')->insert([
            ['month' => 'Januari', 'abbreviation' => 'Jan'],
            ['month' => 'Februari', 'abbreviation' => 'Feb'],
            ['month' => 'Maret', 'abbreviation' => 'Mar'],
            ['month' => 'April', 'abbreviation' => 'Apr'],
            ['month' => 'Mei', 'abbreviation' => 'Mei'],
            ['month' => 'Juni', 'abbreviation' => 'Jun'],
            ['month' => 'Juli', 'abbreviation' => 'Jul'],
            ['month' => 'Agustus', 'abbreviation' => 'Agu'],
            ['month' => 'September', 'abbreviation' => 'Sep'],
            ['month' => 'Oktober', 'abbreviation' => 'Okt'],
            ['month' => 'November', 'abbreviation' => 'Nov'],
            ['month' => 'Desember', 'abbreviation' => 'Des'],
        ]);
    }
}
