<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BabyCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bmi_for_age_categories')->insert([
            ['category' => 'gizi buruk'],
            ['category' => 'gizi kurang'],
            ['category' => 'gizi baik'],
            ['category' => 'berisiko gizi lebih'],
            ['category' => 'gizi lebih'],
            ['category' => 'obesitas'],
        ]);

        DB::table('height_for_age_categories')->insert([
            ['category' => 'sangat pendek'],
            ['category' => 'pendek'],
            ['category' => 'normal'],
            ['category' => 'tinggi'],
        ]);

        DB::table('weight_for_age_categories')->insert([
            ['category' => 'berat badan sangat kurang'],
            ['category' => 'berat badan kurang'],
            ['category' => 'berat badan normal'],
            ['category' => 'risiko berat badan lebih'],
        ]);

        DB::table('weight_for_height_categories')->insert([
            ['category' => 'gizi buruk'],
            ['category' => 'gizi kurang'],
            ['category' => 'gizi baik'],
            ['category' => 'berisiko gizi lebih'],
            ['category' => 'gizi lebih'],
            ['category' => 'obesitas'],
        ]);
    }
}
