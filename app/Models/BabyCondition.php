<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BabyCondition extends Model
{
    use HasFactory;

    protected $table = 'baby_conditions';
    protected $guarded = [];

    public function pregnantWomen()
    {
        return $this->hasMany(PregnantWoman::class, 'baby_condition_id');
    }
}
