<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MotherCondition extends Model
{
    use HasFactory;

    protected $table = 'mother_conditions';
    protected $guarded = [];

    // many to many
    public function pregnancies()
    {
        return $this->hasMany(Pregnancy::class, 'mother_condition_id');
    }

    // many to many puerperal
    public function puerperals()
    {
        return $this->hasMany(Puerperal::class, 'mother_condition_id');
    }
}
