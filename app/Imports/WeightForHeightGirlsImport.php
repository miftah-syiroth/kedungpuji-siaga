<?php

namespace App\Imports;

use App\Models\WeightForHeightGirl;
use Maatwebsite\Excel\Concerns\ToModel;

class WeightForHeightGirlsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new WeightForHeightGirl([
            'periode' => $row[1],
            'height' => $row[2],
            'negative_3sd' => $row[3], 
            'negative_2sd' => $row[4],
            'negative_1sd' => $row[5],
            'median' => $row[6],
            'positive_1sd' => $row[7],
            'positive_2sd' => $row[8],
            'positive_3sd' => $row[9],
        ]);
    }
}
