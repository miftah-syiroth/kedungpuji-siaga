<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BloodGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('blood_groups')->insert([
            ['group' => 'A+'],
            ['group' => 'A-'],
            ['group' => 'B+'],
            ['group' => 'B-'],
            ['group' => 'AB+'],
            ['group' => 'AB-'],
            ['group' => 'O+'],
            ['group' => 'O-'],
        ]);
    }
}
