<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('contraceptions')->insert([
        //     ['contraception' => 'Intra Uterine Device', 'code' => 'I'],
        //     ['contraception' => 'Metode Operasi Wanita', 'code' => 'OW'],
        //     ['contraception' => 'Metode Operasi Pria', 'code' => 'OP'],
        //     ['contraception' => 'Kondom', 'code' => 'K'],
        //     ['contraception' => 'Implan', 'code' => 'IP'],
        //     ['contraception' => 'Suntikan', 'code' => 'S'],
        //     ['contraception' => 'Pil', 'code' => 'P'],
        // ]);

        DB::table('desire_pregnancies')->insert([
            ['desire' => 'Hamil', 'code' => 'H'],
            ['desire' => 'Ingin Anak Segera', 'code' => 'IAS'],
            ['desire' => 'Ingin Anak Tunda', 'code' => 'IAT'],
            ['desire' => 'Tidak Ingin Anak Lagi', 'code' => 'TIAL'],
        ]);

        // DB::table('kb_services')->insert([
        //     ['service' => 'Pemerintah'],
        //     ['service' => 'Swasta'],
        // ]);

        // DB::table('keluarga_sejahtera')->insert([
        //     ['tahapan' => 'Keluarga Pra Sejahtera'],
        //     ['tahapan' => 'Keluarga Sejahtera I'],
        //     ['tahapan' => 'Keluarga Sejahtera II'],
        //     ['tahapan' => 'Keluarga Sejahtera III'],
        //     ['tahapan' => 'Keluarga Sejahtera III Plus'],
        // ]);
    }
}
