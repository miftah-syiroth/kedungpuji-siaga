<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BmiForAgeBoy extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'bmi_for_age_boys';
    protected $guarded = [];
}
