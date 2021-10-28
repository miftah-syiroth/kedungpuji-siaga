<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * WeightForHeightBoy, pada tabel ini terdapat kolom periode dgn value 1 atau 2.
 * pada tabel referensi aslinya, tabel ini terpisah menjadi umur birth to 2 year, dan 2 year to 5 year
 * biar mudah saya gabung jd satu dgn perbedaan pada nilai periode.
 */
class WeightForHeightCategory extends Model
{
    use HasFactory;

    protected $table = 'weight_for_height_categories';
    protected $guarded = [];

    public function anthropometries()
    {
        return $this->hasMany(Anthropometry::class, 'weight_for_height_category_id');
    }
}
