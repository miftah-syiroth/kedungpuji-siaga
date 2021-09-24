<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('religions')->insert([
            ['religion' => 'Islam'],
            ['religion' => 'Kristen'],
            ['religion' => 'Katholik'],
            ['religion' => 'Hindu'],
            ['religion' => 'Buddha'],
            ['religion' => 'Kong Hu Cu'],
            ['religion' => 'Lainnya'],
        ]);
    }
}
