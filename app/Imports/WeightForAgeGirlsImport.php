<?php

namespace App\Imports;

use App\Models\WeightForAgeGirl;
use Maatwebsite\Excel\Concerns\ToModel;

class WeightForAgeGirlsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new WeightForAgeGirl([
            'months' => $row[1],
            'negative_3sd' => $row[2], 
            'negative_2sd' => $row[3],
            'negative_1sd' => $row[4],
            'median' => $row[5],
            'positive_1sd' => $row[6],
            'positive_2sd' => $row[7],
            'positive_3sd' => $row[8],
        ]);
    }
}
