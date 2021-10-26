<?php

namespace App\Imports;

use App\Models\WeightForHeightBoy;
use Maatwebsite\Excel\Concerns\ToModel;

class WeightForHeightBoysImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new WeightForHeightBoy([
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
