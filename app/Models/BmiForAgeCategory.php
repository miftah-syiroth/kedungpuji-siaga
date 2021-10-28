<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BmiForAgeCategory extends Model
{
    use HasFactory;

    protected $table = 'bmi_for_age_categories';
    protected $guarded = [];

    public function anthropometries()
    {
        return $this->hasMany(Anthropometry::class, 'bmi_for_age_category_id');
    }
}
