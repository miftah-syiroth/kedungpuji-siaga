<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DisabilitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('disabilities')->insert([
            ['type' => 'Cacat Fisik'],
            ['type' => 'Cacat Netra/Buta'],
            ['type' => 'Cacat Rungu/Wicara'],
            ['type' => 'Cacat Mental/Jiwa'],
            ['type' => 'Cacat Fisik dan Mental'],
            ['type' => 'Cacat Lainnya'],
        ]);
    }
}
