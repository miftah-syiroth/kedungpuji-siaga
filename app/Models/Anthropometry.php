<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anthropometry extends Model
{
    use HasFactory;

    protected $casts = [
        'visited_at' => 'datetime:Y-m-d',
    ];

    protected $with = [
        'bmiForAgeCategory',
        'heightForAgeCategory',
        'weightForAgeCategory',
        'weightForHeightCategory',
    ];

    protected $table = 'anthropometries';
    protected $guarded = [];

    public function posyandu()
    {
        return $this->belongsTo(Posyandu::class, 'posyandu_id');
    }

    public function bmiForAgeCategory()
    {
        return $this->belongsTo(BmiForAgeCategory::class, 'bmi_for_age_category_id');
    }

    public function heightForAgeCategory()
    {
        return $this->belongsTo(HeightForAgeCategory::class, 'height_for_age_category_id');
    }

    public function weightForAgeCategory()
    {
        return $this->belongsTo(WeightForAgeCategory::class, 'weight_for_age_category_id');
    }

    public function weightForHeightCategory()
    {
        return $this->belongsTo(WeightForHeightCategory::class, 'weight_for_height_category_id');
    }
}
