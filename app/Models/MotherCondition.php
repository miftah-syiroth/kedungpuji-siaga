<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotherCondition extends Model
{
    use HasFactory;

    protected $table = 'mother_conditions';
    protected $guarded = [];

    // many to many puerperal
    public function puerperals()
    {
        return $this->belongsToMany(Puerperal::class, 'puerperal_has_mother_conditions', 'mother_condition_id', 'puerperal_id');
    }
}
