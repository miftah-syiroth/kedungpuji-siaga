<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightForHeightBoy extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'weight_for_height_boys';
    protected $guarded = [];
}
