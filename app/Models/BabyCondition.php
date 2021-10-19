<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BabyCondition extends Model
{
    use HasFactory;

    protected $table = 'baby_conditions';
    protected $guarded = [];

    // many to many
    public function pregnancies()
    {
        return $this->belongsToMany(Pregnancy::class, 'pregnancy_has_baby_conditions', 'baby_condition_id', 'pregnancy_id');
    }

    // many to many puerperal
    public function puerperals()
    {
        return $this->belongsToMany(Puerperal::class, 'puerperal_has_baby_conditions', 'baby_condition_id', 'puerperal_id');
    }
}
