<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BmiForAgeGirl extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'bmi_for_age_girls';
    protected $guarded = [];
}
