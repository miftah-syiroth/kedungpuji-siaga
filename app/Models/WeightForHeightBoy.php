<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * WeightForHeightBoy, pada tabel ini terdapat kolom periode dgn value 1 atau 2.
 * pada tabel referensi aslinya, tabel ini terpisah menjadi umur birth to 2 year, dan 2 year to 5 year
 * biar mudah saya gabung jd satu dgn perbedaan pada nilai periode.
 */
class WeightForHeightBoy extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'weight_for_height_boys';
    protected $guarded = [];
}
