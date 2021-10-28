<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeightForAgeCategory extends Model
{
    use HasFactory;

    protected $table = 'height_for_age_categories';
    protected $guarded = [];

    public function anthropometries()
    {
        return $this->hasMany(Anthropometry::class, 'height_for_age_category_id');
    }
}
