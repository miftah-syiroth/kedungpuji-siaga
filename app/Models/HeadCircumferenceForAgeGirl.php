<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeadCircumferenceForAgeGirl extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'head_circumference_for_age_girls';
    protected $guarded = [];
}
