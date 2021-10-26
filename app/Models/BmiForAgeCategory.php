<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BmiForAgeCategory extends Model
{
    use HasFactory;

    protected $table = 'bmi_for_age_categories';
    protected $guarded = [];
}
