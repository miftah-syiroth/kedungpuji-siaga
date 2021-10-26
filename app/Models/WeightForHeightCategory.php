<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightForHeightCategory extends Model
{
    use HasFactory;

    protected $table = 'weight_for_height_categories';
    protected $guarded = [];
}
