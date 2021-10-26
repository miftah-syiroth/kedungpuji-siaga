<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightForAgeCategory extends Model
{
    use HasFactory;
    
    protected $table = 'weight_for_age_categories';
    protected $guarded = [];
}
