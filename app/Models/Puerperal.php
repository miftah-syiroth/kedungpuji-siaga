<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puerperal extends Model
{
    use HasFactory;

    protected $table = 'puerperals';
    protected $guarded = [];

    protected $with = ['pregnancy.mother'];

    // relasi one to one dengan pregnancy
    public function pregnancy()
    {
        return $this->belongsTo(Pregnancy::class, 'pregnancy_id');
    }

    // many to many baby condition
    public function babyConditions()
    {
        return $this->belongsToMany(BabyCondition::class, 'puerperal_has_baby_conditions', 'puerperal_id', 'baby_condition_id');
    }

    // many to many mother condition
    public function motherConditions()
    {
        return $this->belongsToMany(MotherCondition::class, 'puerperal_has_mother_conditions', 'puerperal_id', 'mother_condition_id');
    }

    // many to many komplikasi ibu
    public function complications()
    {
        return $this->belongsToMany(PuerperalComplication::class, 'puerperal_has_complications', 'puerperal_id', 'puerperal_complication_id');
    }

    public function puerperalClasses()
    {
        return $this->hasMany(PuerperalClass::class, 'puerperal_id');
    }
}
