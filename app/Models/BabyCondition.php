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
    public function childbirths()
    {
        return $this->belongsToMany(Childbirth::class, 'childbirth_has_baby_conditions', 'baby_condition_id', 'childbirth_id');
    }

    // many to many puerperal
    public function puerperals()
    {
        return $this->belongsToMany(Puerperal::class, 'puerperal_has_baby_conditions', 'baby_condition_id', 'puerperal_id');
    }
}
