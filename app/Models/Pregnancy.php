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

    public function getHphtAttribute($value)
    {
        return Carbon::parse($this->attributes['hpht']);
    }

    public function getChildbirthDateAttribute($value)
    {
        return Carbon::parse($this->attributes['childbirth_date']);
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

    public function prenatalClasses()
    {
        return $this->hasMany(PrenatalClass::class, 'pregnancy_id');
    }
}
