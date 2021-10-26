<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pregnancy extends Model
{
    use HasFactory;

    protected $table = 'pregnancies';
    protected $guarded = [];

    protected $casts = [
        'hpht' => 'datetime:Y-m-d',
        'childbirth_date' => 'datetime:Y-m-d',
    ];

    protected $with = ['mother', 'prenatalClasses', 'sex'];

    public function getHphtAttribute($value)
    {
        return Carbon::parse($this->attributes['hpht']);
    }

    public function babyCondition()
    {
        return $this->belongsTo(BabyCondition::class, 'baby_condition_id');
    }
    
    /**
     * mother, sebuah kehamilan tentu saja dimiliki oleh satu individu wanita. tidak mungkin separuh organ dikandung oleh wanita lain macam bongkar pasang
     *
     * @param  mixed $var
     * @return void
     */
    public function mother()
    {
        return $this->belongsTo(Person::class, 'mother_id');
    }
    
    /**
     * setiap kehamilan menghasilkan satu orang atau satu bayi
     *
     * @return void
     */
    public function baby()
    {
        return $this->belongsTo(Person::class, 'baby_id');
    }

    public function prenatalClasses()
    {
        return $this->hasMany(PrenatalClass::class, 'pregnancy_id');
    }

    public function sex()
    {
        return $this->belongsTo(Sex::class, 'sex_id');
    }

    // relasi many to many
    public function babyConditions()
    {
        return $this->belongsToMany(BabyCondition::class, 'pregnancy_has_baby_conditions', 'pregnancy_id', 'baby_condition_id');
    }

    // one to one dengan nifas
    public function puerperal()
    {
        return $this->hasOne(Puerperal::class, 'pregnancy_id');
    }
}
