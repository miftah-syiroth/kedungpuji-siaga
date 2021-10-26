<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HeightForAgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('height_for_age_boys')->insert([
            [
                'months' => 0,
                'negative_3sd' => 44.2, 
                'negative_2sd' => 46.1, 
                'negative_1sd' => 48, 
                'median' => 49.9,
                'positive_1sd' => 51.8,
                'positive_2sd' => 53.7,
                'positive_3sd' => 55.6,
            ],
            [
                'months' => 1,
                'negative_3sd' => 48.9, 
                'negative_2sd' => 50.8, 
                'negative_1sd' => 52.8, 
                'median' => 54.7,
                'positive_1sd' => 56.7 ,
                'positive_2sd' => 58.6 ,
                'positive_3sd' => 60.6 ,
            ],
            [
                'months' => 2,
                'negative_3sd' => 48.9, 
                'negative_2sd' => 50.8, 
                'negative_1sd' => 52.8, 
                'median' => 54.7,
                'positive_1sd' => 56.7 ,
                'positive_2sd' => 58.6 ,
                'positive_3sd' => 60.6 ,
            ],
        ]);
    }
}
