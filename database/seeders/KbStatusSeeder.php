<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KbStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kb_statuses')->insert([
            ['status' => 'Intra Uterine Device', 'code' => 'I'],
            ['status' => 'Metode Operasi Wanita', 'code' => 'OW'],
            ['status' => 'Metode Operasi Pria', 'code' => 'OP'],
            ['status' => 'Kondom', 'code' => 'K'],
            ['status' => 'Implan', 'code' => 'IP'],
            ['status' => 'Suntikan', 'code' => 'S'],
            ['status' => 'Pil', 'code' => 'P'],
            ['status' => 'Hamil', 'code' => 'H'],
            ['status' => 'Ingin Anak Segera', 'code' => 'IAS'],
            ['status' => 'Ingin Anak Tunda', 'code' => 'IAT'],
            ['status' => 'Tidak Ingin Anak Lagi', 'code' => 'TIAL'],
        ]);
    }
}
